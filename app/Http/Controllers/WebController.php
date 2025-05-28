<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    function login(){
        $users = DB::table('user')->get();
        return view('login', ['users' => $users]);
    }
    function validation(Request $request){
        // Ambil user berdasarkan username saja dulu
        $users = DB::table('user')
            ->where('username', $request->username)
            ->first();

        // Cek apakah user ditemukan dan password cocok
        if (!$users || !Hash::check($request->password, $users->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.'
            ]);
        }

        // Simpan ID dan nama user
        session()->put('userActive', [
            'id' => $users->id,
            'nama' => $users->nama
        ]);

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
