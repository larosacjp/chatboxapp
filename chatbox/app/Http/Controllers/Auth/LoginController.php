<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {

      return view('body.login');

    }

    public function logging(Request $request)
    {

      $this->validate($request,[
        'email'=>['required', 'email'],
        'password'=>['required'],
      ]);

      if(!auth()->attempt($request->only('email', 'password')))
      {
        return back()->with('logerror', 'Incorrect email/ password');
      }

      return redirect() -> route('dashboard');

    }
}
