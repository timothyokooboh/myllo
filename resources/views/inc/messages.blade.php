@if(count($errors) > 0)
  @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">{{$error}}</div>
  @endforeach
@endif
  @if(session('success'))
  <!-- <v-snackbar v-model="snackbar" top color="success">
      <span class="subheading text-center">{{session('success')}}</span>
  </v-snackbar> -->
    <div class="alert alert-success" role="alert">{{session('success')}}</div> 
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">{{session('error')}}</div> 
@endif