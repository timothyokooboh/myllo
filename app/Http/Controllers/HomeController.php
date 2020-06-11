<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        //$projects = Project::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->get();
        $projects = auth()->user()->project;

        $tasks = [];

        foreach($projects as $project) {
            array_push($tasks, $project->tasks);
        }

        return view('home')->with(['projects' => $projects, 'tasks' => $tasks]);
    }
}
