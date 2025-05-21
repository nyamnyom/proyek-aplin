<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KasirController extends Controller
{
    function daftar_pesanan(){
        $htrans = DB::table('htrans')->get();
        return view('Kasir.daftar-pesanan', ['htrans' => $htrans]);
    }
    function payment_system(){
        $items = Session::get('order_items', []);
        return view('Kasir.payment-system', compact('items'));
    }

    function kasir_main(){
        $foods = DB::table('menus')->where('is_active', true)->where('category', "Makanan")->get();
        $drinks = DB::table('menus')->where('is_active', true)->where('category', "Minuman")->get();
        $rekomendasi = DB::table('menus')->where('is_active', true)->orderBy('total_ordered', 'desc')->get();
        return view('Kasir.kasir-main', ['foods' => $foods, 'drinks' => $drinks, 'rekomendasi' => $rekomendasi]);

    }
    
    function reservasi_meja() {
        $reservasi = DB::table('reservasi_meja')->orderBy('tanggal_reservasi', 'desc')->get();
        return view('Kasir.reservasi-meja', compact('reservasi'));
    }
    
    public function insert_reservasi(Request $request) {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_reservasi' => 'required|date',
            'waktu_reservasi' => 'required',
            'nomor_meja' => 'required|string|max:5',
            'jumlah_tamu' => 'required|integer',
        ]);

        // Ambil kapasitas meja
        $kapasitasMeja = DB::table('meja')
            ->where('nomor_meja', $request->nomor_meja)
            ->value('kapasitas');

        // Validasi jika jumlah tamu melebihi kapasitas meja
        if ($request->jumlah_tamu > $kapasitasMeja) {
            return back()->with('error', 'Jumlah tamu melebihi kapasitas meja.')->withInput();
        }

        // Cek apakah meja sudah dipesan di tanggal & waktu yang sama
        $cek = DB::table('reservasi_meja')
            ->where('tanggal_reservasi', $request->tanggal_reservasi)
            ->where('waktu_reservasi', $request->waktu_reservasi)
            ->where('nomor_meja', $request->nomor_meja)
            ->first();

        if ($cek) {
            return back()->with('error', 'Meja sudah dipesan pada waktu tersebut.')->withInput();
        }

        // Insert data reservasi
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

    public function setSessionOrder(Request $request)
    {
        $orderItems = $request->input('order_items'); // array dari JavaScript
        Session::put('order_items', $orderItems);

        return response()->json(['success' => true]);
    }

    
    public function insertTransaction(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        $total = $request->input('total');
        $kasirId = 1; // Ubah sesuai session user login jika tersedia

        // Insert ke htrans
        $htransId = DB::table('htrans')->insertGetId([
            'payment_method' => $paymentMethod,
            'total' => $total,
            'kasir_id' => $kasirId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Insert ke dtrans
        foreach ($request->input('items') as $item) {
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

        // Kosongkan session order_items setelah transaksi berhasil
        Session::forget('order_items');

        return redirect('/daftar-pesanan')->with('success', 'Pembayaran berhasil disimpan!');
    }

}
