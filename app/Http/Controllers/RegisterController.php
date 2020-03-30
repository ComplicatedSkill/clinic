<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }
}