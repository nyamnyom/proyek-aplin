<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;

class AdminController extends Controller
{
    function dashboard(){
        return view('Admin.dashboard');
    }
    function daftar_event(){
        return view('Admin.daftar-event');
    }
    function edit_bahan(){
        return view('Admin.edit-bahan');
    }
    function inventaris(){
        return view('Admin.inventaris');
    }
    function manajemen_menu(){
        return view('Admin.manajemen-menu');
    }
    function manajemen_pegawai(){
        return view('Admin.manajemen-pegawai');
    }
    function riwayat_penjualan(){
        return view('Admin.riwayat-penjualan');
    }
    function tambah_bahan(){
        return view('Admin.tambah-bahan');
    }
    public function get_all_user(){
        $users = User::all();
        return response()->json($users);
    }
    public function add_user(Request $request)
        {
            $request->validate([
                'username' => 'required|string', 
                'nama' => 'required|string', 
                'posisi' => 'required', 
                'password' => 'required|string|min:6',
                'is_active' => 'boolean'
            ]);

            $user = User::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'posisi' => $request->posisi,
                'password' => $request->password,
                'is_active' => 1,
            ]);

            return response()->json([
                'message' => 'User berhasil dibuat',
                'user' => $user
            ]);
        }
}
