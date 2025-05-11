<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

use App\Models\Htrans;
use App\Models\Dtrans;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;


class CustomerController extends Controller
{
    // Halaman utama
    public function home()
    {
        return view('Customer.Customer');
    }

    // Menampilkan menu dine-in
    public function dineIn()
    {
        $menus = DB::table('menus')->where('is_active', true)->get();
        return view('Customer.Dine-in', ['menus' => $menus]);
    }

    // Menampilkan halaman checkout
    public function checkout()
    {
        return view('Customer.Checkout');
    }

    // Menambahkan item ke dalam cart
    public function addToCart($id)
    {
        $menu = DB::table('menus')->where('id', $id)->first();

        if ($menu) {
            $item = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'qty' => 1,
            ];

            $cart = session()->get('cart', []);
            $found = false;

            foreach ($cart as &$cartItem) {
                if ($cartItem['id'] === $item['id']) {
                    $cartItem['qty'] += 1;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $cart[] = $item;
            }

            session()->put('cart', $cart);
        }

        return redirect('/Customer/Dine-in');
    }

    // Memperbarui cart (jumlah pesanan)
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        
        foreach ($request->cart as $key => $item) {
            if (isset($cart[$key])) {
                $cart[$key]['qty'] = $item['qty'];
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('checkout')->with('success', 'Pesanan telah diperbarui.');
    }

    
    // Memproses checkout dan metode pembayaran
   // Memproses checkout dan metode pembayaran
public function processCheckout(Request $request)
{
    $cart          = session('cart', []);
    $paymentMethod = $request->input('payment_method', 'cash');

    if (empty($cart)) {
        return redirect()->route('customer.dineIn')
                         ->with('error', 'Tidak ada pesanan.');
    }

    // Hitung total
    $total = array_reduce($cart, fn($sum, $i) => $sum + ($i['price'] * $i['qty']), 0);

    // Simpan Htrans
    $htrans_id = DB::table('htrans')->insertGetId([
        'total'          => $total,
        'payment_method' => $paymentMethod,
        'created_at'     => now(),
        'updated_at'     => now(),
    ]);

    // Simpan Dtrans
    foreach ($cart as $i) {
        DB::table('dtrans')->insert([
            'htrans_id'  => $htrans_id,
            'item_name'  => $i['name'],
            'qty'        => $i['qty'],
            'price'      => $i['price'],
            'subtotal'   => $i['price'] * $i['qty'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Kosongkan cart
    Session::forget('cart');

    // Jika QRIS → generate QR dan simpan ke session
    if ($paymentMethod === 'qris') {
        $orderId  = 'ORDER-' . uniqid();
        $serverKey = env('MIDTRANS_SERVER_KEY');

        // Panggil API Midtrans
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.sandbox.midtrans.com/v2/charge', [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $total,
            ],
            'qris' => [
                'acquirer' => 'gopay'
            ]
        ]);

        $result = $response->json();

        if ($response->successful() && isset($result['actions'][0]['url'])) {
            session(['qrUrl' => $result['actions'][0]['url']]);
            return redirect()->route('checkout.nota', ['id' => $htrans_id]);
        } else {
            return back()->with('error', 'Gagal generate QRIS: ' . json_encode($result));
        }
    }

    // Cash/Debit → langsung ke nota tanpa QR
    return redirect()->route('checkout.nota', ['id' => $htrans_id])
                     ->with('success', 'Pembayaran berhasil.');
}

    public function nota($id)
    {
        $htrans = Htrans::findOrFail($id);
        $dtrans = Dtrans::where('htrans_id', $id)->get();

        // ambil QR URL jika ada, lalu hapus dari session
        $qrUrl = session('qrUrl');
        Session::forget('qrUrl');

        return view('Customer.nota', compact('htrans', 'dtrans', 'qrUrl'));
    }
    
    // getWeather api
    public function getWeather($city)
{
    $apiKey = env('WEATHER_API_KEY');
    $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
        'q' => $city,
        'appid' => $apiKey,
        'units' => 'metric', // Celsius
    ]);

    if ($response->successful()) {
        return response()->json($response->json());
    } else {
        return response()->json(['error' => 'Gagal mengambil data cuaca'], 500);
    }
}



}
