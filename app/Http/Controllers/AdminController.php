<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    function dashboard(){
        return view('Admin.dashboard');
    }
}
