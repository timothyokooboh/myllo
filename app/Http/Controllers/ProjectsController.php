<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;

class ProjectsController extends Controller
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
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'tasks' => ['required'],
            'due' => ['required', 'max:255']
        ]);

        //dd($request['due']);

        // Project::create([
        //     'title'=> $request['title'],
        //     'description'=> $request['description'],
        //     'tasks'=> $request['tasks'],
        //     'due'=> $request['due'],
        //     'user_id'=> auth()->user()->id
        // ]);

        $project = new Project();
        $project->title = $request['title'];
        $project->description = $request['description'];
        $project->due = $request['due'];
        $project->user_id = auth()->user()->id;
        $project->tasks = $request['tasks'];

        // foreach($request['tasks'] as $task) {
        //     $project->tasks = $request['task'];
        // }

        $project->save();


        return redirect('/home')->with('success', 'Awesome! You added a project');
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
        //
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
        //
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
