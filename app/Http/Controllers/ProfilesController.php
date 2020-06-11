<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Profile;
use Session;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('profiles.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstName' => ['string', 'nullable', 'max:255'],
            'lastName' => ['string', 'nullable', 'max:255'],
            'username' => ['string', 'nullable', 'max:255'],
            'avatar' => ['image', 'nullable', 'max:1999']
        ]);

        $snackbar = false;
 
        //handle file upload
        if ($request->hasFile('avatar')) {
 
            //Get file name with extension
         
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName(); 
         
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
         
            //Get just extension
            $extension = $request->file('avatar')->getClientOriginalExtension(); 
         
            //file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
         
            //upload image
            $request->file('avatar')->storeAs('public/profilePictures', $fileNameToStore);
        } 

        $profile = Profile::findOrFail($id);
          $profile->firstName = $request['firstName'];
          $profile->lastName = $request['lastName'];
          $profile->username = $request['username'];
          
        if ($request->hasFile('avatar')) {
            Storage::delete('public/profilePictures/'.$profile->avatar);
            $profile->avatar = $fileNameToStore;
        }
            
          $profile->save();

          if($profile->save()){
            $snackbar = true;
          }

        return redirect(route('profiles.edit', [ 'id' => $profile->id]))->with('snackbar', $snackbar);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
