<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    function login(){
        $users = DB::table('user')->get();
        return view('login', ['users' => $users]);
    }
    function register(){
        return view('register');
    }
}
