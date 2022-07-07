<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Resources\Js\chatjquery;


class ChatController extends Controller
{
    public function chatin()
    {
      $chats = Chat::orderBy('created_at', 'desc')->take(10)->get();
      $chats = $chats->reverse();
      return view('body.chat')->with(compact('chats'));

    }

    public function chatting(Request $request)
    {
      $this->validate($request,[
        'inputChat'=>['required'],
      ]);

      if($request->inputChat =='')
      {

      }else{
        $chat = Chat::create([
          'chat' => $request->inputChat,
          'username' => $request->userChat,
        ]);
    
      }

    }

    public function chatUpdate(Request $request)
    {
      $lastid = $request->idLast;
      $updates = Chat:: orderBy('created_at','desc')->where('id', '>', $lastid)->get();

      foreach($updates as $update)
      {
        if(auth()->user()->username == $update->username)
        {
           echo '<div class = "chatentryuser flex-container"><pre class = "chatpreuser">'.$update->chat.'</pre><span class = "user">'.$update->username.'</span></div>';
           echo '<input type = "text" class = "chatid" value = "'.$update->id.'" hidden></input>';
        }else
        {

           echo '<div class = "chatentrynotuser flex-container"><span class = "notuser">'.$update->username.'</span><pre class = "chatprenotuser">'.$update->chat.'</pre></div>';
           echo '<input type = "text" class = "chatid" value = "'.$update->id.'" hidden></input>';
        }

      }



    }

    public function reloadChat(Request $request)
    {
      $chatlast = $request->idFirst - 1;
      $chatini = $chatlast - 10;
      if($chatini < 1)
      {
        $chatini = 1;
      }
      $reloads = Chat:: orderBy('created_at','desc')->whereBetween('id', [$chatini, $chatlast])->get();
      $reloads = $reloads->reverse();

      foreach($reloads as $reload)
      {
        if(auth()->user()->username == $reload->username)
        {
           echo '<div class = "chatentryuser flex-container"><pre class = "chatpreuser">'.$reload->chat.'</pre><span class = "user">'.$reload->username.'</span></div>';
           echo '<input type = "text" class = "chatid" value = "'.$reload->id.'" hidden></input>';
        }else
        {

           echo '<div class = "chatentrynotuser flex-container"><span class = "notuser">'.$reload->username.'</span><pre class = "chatprenotuser">'.$reload->chat.'</pre></div>';
           echo '<input type = "text" class = "chatid" value = "'.$reload->id.'" hidden></input>';
        }
      }


    }

}
