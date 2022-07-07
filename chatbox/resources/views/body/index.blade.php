@extends('layouts.homelayout')

@section('content')

    <div style = "text-align:center; padding: 1em;">
      <div style = "font-size: 5em; font-family: 'Nunito', sans-serif; font-weight: bold; padding-top: 1em; ">Welcome!</div>


    @if(auth()->user())
      <div style = "font-size: 14pt; color: gray; font-weight:lighter; padding-bottom: 2em;r">Proceed to the dashboard</div>
    @else

    <div style = "font-size: 14pt; color: gray; font-weight:lighter; padding-bottom: 2em;r">Click a button below to start</div>
    <button class = " btn btn-primary"><a href = "{{ route('login')}}" style = "color: white ">Login</a></button>
    <button class = "btn btn-primary"><a href = "{{ route('register')}}" style = "color: white">Register</a></button>

    @endif
  </div>
@endsection
