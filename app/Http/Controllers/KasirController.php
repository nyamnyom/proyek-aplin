<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;


class KasirController extends Controller
{
    function daftar_pesanan(){
        return view('Kasir.daftar-pesanan');
    }
    function payment_system(){
        // Ambil data dari session/localStorage, atau testing dummy
        $items = []; // Sementara kosong atau bisa ambil dari session kalau kamu simpan sebelumnya
        return view('Kasir.payment-system', compact('items'));
    }

    function kasir_main(){
        $foods = DB::table('menus')->where('is_active', true)->where('category', "Makanan")->get();
        $drinks = DB::table('menus')->where('is_active', true)->where('category', "Minuman")->get();
        $rekomendasi = DB::table('menus')->where('is_active', true)->orderBy('total_ordered', 'desc')->get();
        return view('Kasir.kasir-main', ['foods' => $foods, 'drinks' => $drinks, 'rekomendasi' => $rekomendasi]);

    }
    function reservasi_meja(){
        return view('Kasir.reservasi-meja');
    }
    
    function checkout(Request $request){
        // dd($request->input('orderDetails'));
    $items = $request->input('orderDetails'); // pakai nama field yang benar dari AJAX

    return response()->json([
        'message' => 'Sukses',
        'redirect' => route('payment.system'),
        'data' => $items,
    ]);
    }

    function insertTransaction(Request $request) {
        DB::beginTransaction();
        try {
            // Simpan htrans
            $htransId = DB::table('htrans')->insertGetId([
                'payment_method' => $request->payment_method,
                'total' => $request->total,
                'kasir_id' => $request->kasir_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Simpan dtrans
            foreach ($request->items as $item) {
                DB::table('dtrans')->insert([
                    'htrans_id' => $htransId,
                    'item_name' => $item['item_name'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Transaksi berhasil']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan transaksi'], 500);
        }
        
    }

    function insert_reservasi(Request $request) {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_reservasi' => 'required|date',
            'waktu_reservasi' => 'required',
            'nomor_meja' => 'required|string|max:5',
            'jumlah_tamu' => 'required|integer',
        ]);

        // Cek apakah meja sudah dipesan di tanggal & waktu yang sama
        $cek = DB::table('reservasi_meja')
            ->where('tanggal_reservasi', $request->tanggal_reservasi)
            ->where('waktu_reservasi', $request->waktu_reservasi)
            ->where('nomor_meja', $request->nomor_meja)
            ->first();

        if ($cek) {
            return back()->with('error', 'Meja sudah dipesan pada waktu tersebut.')->withInput();
        }

        // Jika aman, insert
        DB::table('reservasi_meja')->insert([
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_telepon' => $request->nomor_telepon,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'waktu_reservasi' => $request->waktu_reservasi,
            'nomor_meja' => $request->nomor_meja,
            'jumlah_tamu' => $request->jumlah_tamu,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/reservasi-meja')->with('success', 'Reservasi berhasil disimpan!');
    }
}
