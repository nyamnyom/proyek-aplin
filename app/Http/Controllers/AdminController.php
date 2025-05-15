<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Dtrans;
use App\Models\Htrans;
use App\Models\Promo;

use Illuminate\Support\Facades\DB;

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
        $menus = DB::table('menus')->get();
        return view('Admin.manajemen-menu', ['menus' => $menus]);
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
    public function add_user(Request $request) //blomm jadi
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'nama' => 'required|string',
            'posisi' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($validated);

        return response()->json(['message' => 'User berhasil dibuat', 'user' => $user]);
    }
        public function getDtrans() 
    {
        $dtrans = Dtrans::all(); // ambil semua data 
        return response()->json($dtrans); 
    }
    public function get_all_promo() 
    {
        $promo = Promo::all(); // ambil semua data 
        return response()->json($promo); 
    }
    public function getHtrans() 
    {
        $htrans = Htrans::all(); // ambil semua data 
        return response()->json($htrans); 
    }
    public function getTransaction() 
    {
        $htrans = Htrans::all(); // ambil semua data 
        $user = User::all(); // ambil semua data 
        return response()->json(['htrans' => $htrans, 'user' => $user]); 
    }
}
