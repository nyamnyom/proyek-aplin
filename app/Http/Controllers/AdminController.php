<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Dtrans;
use App\Models\Htrans;
use App\Models\Menu;
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

    public function insertMenu(Request $req){
        $validated = $req->validate([
            'name' => 'required|max:255',
            'kategori' => 'required|in:Makanan,Minuman',
            'harga' => 'required|integer|min:1000',
            'image_url' => 'nullable|string',
            'deskripsi' => 'required|string'
        ]);

        Menu::create([
            'name' => $validated['name'],
            'category' => $validated['kategori'],
            'price' => $validated['harga'],
            'description' => $validated['deskripsi'],
            'image_url' => $validated['image_url'] ?? 'default.jpg',
        ]);

        return response()->json(['message' => 'Menu berhasil ditambahkan'], 200);
    }
    public function updateMenu(Request $req, $id) {
        $validated = $req->validate([
            'name' => 'required|max:255',
            'kategori' => 'required|in:Makanan,Minuman',
            'harga' => 'required|integer|min:1000',
            'image_url' => 'nullable|string',
            'deskripsi' => 'required|string'
        ]);

        $menu = Menu::findOrFail($id);
        
        $menu->update([
            'name' => $validated['name'],
            'category' => $validated['kategori'],
            'price' => $validated['harga'],
            'description' => $validated['deskripsi'],
            'image_url' => $validated['image_url'] ?? $menu->image_url,
        ]);

        return response()->json(['success' => true, 'message' => 'Menu berhasil diperbarui']);
    }

    public function deleteMenu($id) {
        $menu = Menu::findOrFail($id);
        
        // Soft delete dengan mengupdate is_active menjadi 0
        $menu->update([
            'is_active' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dinonaktifkan'
        ]);
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
}