<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    function login(){
        $users = DB::table('user')->get();
        return view('login', ['users' => $users]);
    }
    function validation(Request $request){
        $users = DB::table('user')->where('username', $request->username)->where('password', $request->password)->first();

        if (!$users){
            return redirect('/login')->with('error', 'User tidak ditemukan');
        }

        session()->put('userActive', $users->nama);
        return response()->json([
            'success' => true,
            'redirect' => '/kasir-main'
        ]);
    }
    function logout(){
        // Kosongkan cart
        Session::forget('userActive');
        return redirect('/login');
    }
}
