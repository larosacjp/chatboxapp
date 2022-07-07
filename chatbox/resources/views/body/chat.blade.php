@extends('layouts.homelayout')

@section('content')
<link rel = "stylesheet" href = "{{asset('/css/chatstyle.css')}}" />
<script src="{{asset('/js/chatjquery.js')}}" type = "text/javascript"></script>
<div style = "text-align:center; ">
    <h1>Chatbox</h1>
    <div id = "content">
      @isset($chats)
        @foreach($chats as $chat)
          @if(auth()->user()->username == $chat->username)

            <div class = "chatentryuser flex-container"><pre class = "chatpreuser">{{ $chat->chat}}</pre><span class = "user">{{$chat->username}}</span></div>
            <input type = "text" class = "chatid" value = "{{$chat->id}}" hidden></input>
          @else

            <div class = "chatentrynotuser flex-container"><span class = "notuser">{{$chat->username}}</span><pre class = "chatprenotuser">{{ $chat->chat}}</pre></div>
            <input type = "text" class = "chatid" value = "{{$chat->id}}" hidden></input>
          @endif
        @endforeach
      @endisset
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
      <input type = "text" id = "chatInput" name = "chat" ></input>
      <input type = "text" id = "chatUsername" name = "username" value = "{{auth()->user()->username}}" hidden/>
      <input type = "submit" id = "chatsubmit" name = "submit" value = "Enter"/>

  </div>


@endsection
