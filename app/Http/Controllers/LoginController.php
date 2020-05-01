<?php

namespace App\Http\Controllers;
use Validator;
use Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function index(){
        return view('login');
    }

    function checklogin(Request $request){
        $username = $request->user_name;
        $password = $request->password;
        Auth::attempt(['username'=>$username,'password'=>$password]);
    }
}
