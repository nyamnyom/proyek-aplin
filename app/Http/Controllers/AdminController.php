<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Dtrans;
use App\Models\Htrans;
use App\Models\Menu;
use App\Models\Promo;
use App\Models\Shift;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function get_shift(){
        $shifts = Shift::all();
        return response()->json($shifts);
    }
    public function get_menu(){
        $menu = Menu::all();
        return response()->json($menu);
    }
    public function add_shift(Request $request)
    {
        DB::table('shift')->insert([
            'user_id' => $request->user_id,
            'hari_masuk' => $request->hari_masuk,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        return response()->json(['message' => 'User berhasil ditambahkan']);
    }
    public function update_shift(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'shifts' => 'required|array',
            'shifts.*.hari_masuk' => 'required|string',
            'shifts.*.jam_masuk' => 'required|string',
            'shifts.*.jam_pulang' => 'required|string',
        ]);

        // Hapus shift lama user
        DB::table('shift')->where('user_id', $request->user_id)->delete();

        // Tambahkan shift baru
        $newShifts = array_map(function ($shift) use ($request) {
            return [
                'user_id' => $request->user_id,
                'hari_masuk' => $shift['hari_masuk'],
                'jam_masuk' => $shift['jam_masuk'],
                'jam_pulang' => $shift['jam_pulang'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $request->shifts);

        DB::table('shift')->insert($newShifts);

        return response()->json(['message' => 'Shift berhasil diperbarui']);
    }
    public function add_user(Request $request) //blomm jadi
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'nama' => 'required|string',
            'posisi' => 'required|string',
            'password' => 'required|string',
        ]);

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json(['message' => 'User berhasil dibuat', 'id' => $user->id, 'user' => $user]);
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
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string'
        ]);

        $extension = $req->file('image')->getClientOriginalExtension();
        $cleanName = preg_replace('/[^a-z0-9]+/', '_', strtolower($req->name));
        $fileName = "{$cleanName}.{$extension}";

        // Simpan ke public/images
        $req->file('image')->move(public_path('uploads'), $fileName);

        Menu::create([
            'name' => $validated['name'],
            'category' => $validated['kategori'],
            'price' => $validated['harga'],
            'description' => $validated['deskripsi'],
            'image_url' => 'uploads/' . $fileName,
        ]);

        return response()->json(['message' => 'Menu berhasil ditambahkan'], 200);
    }

    public function updateMenu(Request $req, $id) {
        $validated = $req->validate([
            'name' => 'required|max:255',
            'kategori' => 'required|in:Makanan,Minuman',
            'harga' => 'required|integer|min:1000',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string'
        ]);

        $menu = Menu::findOrFail($id);
        $imagePath = $menu->image_url;

        if ($req->hasFile('image')) {
            // Hapus gambar lama
            if (file_exists(public_path($menu->image_url))) {
                unlink(public_path($menu->image_url));
            }

            // Buat nama file baru dari title
            $extension = $req->file('image')->getClientOriginalExtension();
            $cleanName = preg_replace('/[^a-z0-9]+/', '-', strtolower($req->name));
            $newFilename = "{$cleanName}.{$extension}";

            // Simpan file baru
            $req->file('image')->move(public_path('images'), $newFilename);
            $imagePath = 'images/' . $newFilename;
        }
        
        $menu->update([
            'name' => $validated['name'],
            'category' => $validated['kategori'],
            'price' => $validated['harga'],
            'description' => $validated['deskripsi'],
            'image_url' => $imagePath,
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
    public function deleteByUser($id)
    {
        DB::table('shift')->where('user_id', $id)->delete();
    
        return response()->json(['message' => 'Shift berhasil dihapus']);
    }
    public function add_promo(Request $request)
    {
        DB::table('promo')->insert([
            'nama_promo' => $request->nama_promo,
            'kode_promo' => $request->kode_promo,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_active' => $request->is_active ?? 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        return response()->json(['message' => 'Promo berhasil ditambahkan']);
    }

    public function update_promo(Request $request, $id)
    {
        $promo = DB::table('promo')->where('id', $id)->first();
    
        if (!$promo) {
            return response()->json(['message' => 'Promo tidak ditemukan'], 404);
        }
    
        DB::table('promo')->where('id', $id)->update([
            'nama_promo' => $request->nama_promo,
            'kode_promo' => $request->kode_promo,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_active' => $request->is_active ?? $promo->is_active,
            'updated_at' => now()
        ]);
    
        return response()->json(['message' => 'Promo berhasil diperbarui']);
    }
}