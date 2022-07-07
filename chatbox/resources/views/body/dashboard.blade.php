@extends('layouts.homelayout')

@section('content')

    <div style = "text-align:center; padding: 1em;">
      <div style = "font-size: 3em; font-family: 'Nunito', sans-serif; font-weight: bold; padding-top: 1em; ">Welcome User: {{auth()->user()->name}}</div>
      <div style = "font-size: 18pt; color: #3260ab; font-weight:lighter; padding-bottom: 2em;r"></div>
      @if (Session::has('error'))

      <div style = "color:red">{{ Session::get('error')}}</div>

      @elseif (Session::has('success'))

      <div style = "color:green">{{Session::get('success')}}</div>

      @endif

      <img src="{{ asset('Paypal_2014_logo.png') }}" alt="Paypal Logo" width = "100px" style = "margin:1em"/>

  <form action = "{{ route('processPaypal')}}" method = "get">

   @csrf


   <input type = "number" name = "price" @error('price') border-style:solid; border-width: 2px; border-color: red; @enderror id = "price" placeholder = "Enter amount" />
   @error('number')
     <span style = "color:red; font-size:10pt;">{{$message}}</span>
   @enderror
   <input type = "submit" class = "btn btn-secondary" name = "submit" value = "Submit" />

  </form>

  </div>
@endsection
