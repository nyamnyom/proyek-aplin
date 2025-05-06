<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;

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
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/Customer/Dine-in')->with('error', 'Cart kosong, silakan tambahkan item terlebih dahulu');
        }

        // Simpan data transaksi ke database (misalnya, buat transaksi dan simpan ke tabel transaksi)
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // Simulasi proses pembayaran (Anda bisa menambahkan model untuk transaksi atau pembayaran)
        // Misalnya, simpan transaksi ke dalam database atau menggunakan API payment gateway

        // Pilih metode pembayaran
        $payment_method = $request->input('payment_method');
        
        // Proses pembayaran berdasarkan metode yang dipilih
        if ($payment_method == 'transfer') {
            // Logic pembayaran transfer bank
        } else {
            // Logic pembayaran cash on delivery
        }

        // Setelah proses selesai, hapus cart dari session
        session()->forget('cart');

        return redirect('/')->with('success', 'Pembayaran berhasil, terima kasih!');
    }
}
