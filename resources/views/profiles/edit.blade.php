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
      <Edit-Profile
        form-action = "/profiles/{{auth()->user()->profile->id}}"
        username = "{{auth()->user()->profile->username}}"
        first-name = "{{auth()->user()->profile->firstName}}"
        last-name = "{{auth()->user()->profile->lastName}}"
        avatar = "/storage/profilePictures/{{auth()->user()->profile->avatar}}"
        is-avatar = "{{auth()->user()->profile->avatar}} !== NULL"
        snackbar = "{{ session()->get('snackbar') }}"
      >
       <template v-slot:csrf>
          {{csrf_field()}}
       </template>
       <template v-slot:patch>
          {{method_field('PATCH')}}
       </template>
       
      </Edit-Profile>

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
      
    </v-container>

@endsection

<script>
    function loadFile (event) {
    var output = document.getElementById('picture');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>