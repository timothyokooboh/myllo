

@extends('layouts.app')
  <style>
    body::-webkit-scrollbar {
      display: none;
    }
    body {
      overflow-y: scroll;
      -ms-overflow-style: none;
    }
    main {
      margin-top: 40px;
    }
    .grid-container {
      display: grid;
      grid-template-columns: auto auto;
      justify-content: center;
      column-gap: 50px;
      height: 100%;
      background: #09224A;
      padding-bottom: 60px;
    }
    .project-description {
      margin-top: 100px;
      text-align: center;
    }
    @media (max-width: 900px) {
      .grid-container {
        grid-template-columns: auto;
        grid-template-rows: 300px;
        row-gap: 20px;
      }
      img {
        width: 300px;
        object-fit: cover;
      }
    }
  </style>


@section('content')

  <div class="grid-container">
    <div>
      <img src="/images/human.png" alt="image of an animated human">
    </div>

    <div class="project-description">

      <div>
        <v-btn text color="#12FFCD">
          <span class="display-3 font-weight-bold">Myllo</span>
          <v-icon right large class="mx-3 ">mdi-notebook-multiple</v-icon>
        </v-btn>
      </div>

      <div>
        <v-btn text class="my-5" color="#12FFCD">
          A PERSONAL PROJECT MANAGEMENT TOOL
        </v-btn>
      </div>

      <div>
        <v-btn large class="my-5" color="#12FFCD" onclick="registerRoute()">
          Get Started
        </v-btn>
      </div>

    </div>
  </div>
    
@endsection

@section('scripts')
  <script>
    function registerRoute() {
      window.location = '/register'
    }
  </script>
@endsection
