@extends('layouts.app')

@section('styles')
    <style>
        main {
            margin-top: 80px;
        }
    </style>
@endsection

@section('content')
    <v-container>
        <Navbar-Component
                avatar = "/storage/profilePictures/{{auth()->user()->profile->avatar}}"
                is-avatar = "{{auth()->user()->profile->avatar}} !== NULL"
                is-username = "{{auth()->user()->profile->username}} !== NULL"
                username =  "{{auth()->user()->profile->username}}"
                email = "{{auth()->user()->email}}"
                edit-profile-route = "/profiles/{{auth()->user()->profile->id}}/edit"
            >
            {{csrf_field()}}
        </Navbar-Component>

        <Expansion-Panel-Component
            projects = "{{$projects}}"
        >
        <template v-slot:projects>
            {{$projects}}
        </template>
        </Expansion-Panel-Component>


            <!-- <v-expansion-panels>
                @foreach(auth()->user()->project as $project)
                    <v-expansion-panel>

                        <v-expansion-panel-header>
                            <div class="title">{{$project->title}}</div>
                        </v-expansion-panel-header>

                        <v-expansion-panel-content>
                            <v-card class="pa-3">
                                <div class="subheading font-weight-bold">{{$project->description}}</div>
                                <ul style="list-style-type:none">
                                    @foreach($project->tasks as $task)
                                        <li><input type="checkbox" name="$task"> {{$task}}</li>
                                    @endforeach
                                </ul>
                            </v-card>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                @endforeach
            </v-expansion-panels> -->
    
      
    </v-container>
@endsection
