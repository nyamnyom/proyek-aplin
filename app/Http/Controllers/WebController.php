<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    function login(){
        return view('login');
    }
    function register(){
        return view('register');
    }
}
