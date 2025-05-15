<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Dtrans;
use App\Models\Htrans;
use App\Models\Promo;
use App\Models\Menus;

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
        DB::table('user')->insert([
            'username' => $request -> username,
            'nama' => $request -> nama,
            'posisi' => $request -> posisi,
            'PASSWORD' => $request -> password,
            'is_active' => $request->is_active ?? 1,
            'created_at' => now(),
            'updated_at' => now()

        ]);

        return response()->json(['message' => 'User berhasil dibuat']);
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
    public function getMenus() 
    {
        $menus = Menus::all(); // ambil semua data 
        return response()->json($menus); 
    }
    public function getTransaction() 
    {
        $htrans = Htrans::all(); // ambil semua data 
        $user = User::all(); // ambil semua data 
        return response()->json(['htrans' => $htrans, 'user' => $user]); 
    }
    public function getMenu() 
    {
        $htrans = Htrans::all(); // ambil semua data 
        $user = User::all(); // ambil semua data 
        return response()->json(['htrans' => $htrans, 'user' => $user]); 
    }
    public function update_menu(Request $request, $id)
    {
        DB::table('menus')->where('id', $id)->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->is_active ?? 1,
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Menu berhasil diperbarui']);
    }
    public function add_menu(Request $request)
    {
        DB::table('menus')->insert([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->is_active ?? 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response()->json(['message' => 'Menu berhasil ditambahkan']);
    }
    public function add_promo(Request $request)
    {
        DB::table('promo')->insert([
            'nama_promo' => $request->nama_promo,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_active' => $request->is_active ?? 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        return response()->json(['message' => 'Promo berhasil ditambahkan']);
    }
    public function delete_menu($id)
    {
        DB::table('menus')->where('id', $id)->delete();
        return response()->json(['message' => 'Menu berhasil dihapus']);
    }
}
