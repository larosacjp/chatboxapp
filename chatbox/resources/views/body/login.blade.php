@extends('layouts.homelayout')

@section('content')

<div class = "d-flex justify-content-center" style = "padding: 1em;">
  <form action = '{{route("login")}}' method = 'post' style = "padding:1em; background-color:#e0e0e0; border-radius:10px;">
    <h3>Login</h3><hr style = "border: 1px solid ">
    @if(session('logerror'))
      <span style = "color:red">{{session("logerror")}}</span>
    @endif

    @csrf
    <div class="form-group" style = "padding-top:1em">
      <input type="text" class="form-control" id="email" style = "width:25em;  @error('email') border-style:solid; border-width: 2px; border-color: red; @enderror" name = 'email' placeholder="Enter your email" value = "{{ old('email') }}"/>
      @error('email')
        <span style = "color:red; font-size:10pt;">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group" style = "padding-top:1em">
      <input type="password" class="form-control" id="password" style = "width:25em;  @error('password') border-style:solid; border-width: 2px; border-color: red; @enderror" name = 'password' placeholder="Enter Password">
      @error('password')
        <span style = "color:red; font-size:10pt;">{{$message}}</span>
      @enderror
    </div>
    <div class="form-group" style = "padding-top:1em">
      <input type="submit" class="form-control btn btn-primary" id="submit" name = 'submit' value = "Submit">
    </div>
  </form>
</div>


@endsection
