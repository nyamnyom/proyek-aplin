<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Htrans;
use App\Models\Dtrans;


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
public function process(Request $request)
{
    $cart = session('cart');
    if (!$cart || count($cart) == 0) {
        return redirect('/Customer/Dine-in')->with('error', 'Tidak ada pesanan.');
    }

    // Hitung total
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }

    // Simpan Htrans (nota utama)
    $htrans_id = DB::table('htrans')->insertGetId([
        'total' => $total,
        'payment_method' => $request->payment_method,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Simpan Dtrans (detail barang)
    foreach ($cart as $item) {
        DB::table('dtrans')->insert([
            'htrans_id' => $htrans_id,
            'item_name' => $item['name'],
            'qty' => $item['qty'],
            'price' => $item['price'],
            'subtotal' => $item['price'] * $item['qty'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    // Kosongkan cart session
    Session::forget('cart');

    // Redirect ke halaman nota
    return redirect()->route('checkout.nota', ['id' => $htrans_id]); // <- Ini dia
}

    public function nota($id)
    {
        // Cek apakah transaksi ditemukan
        $htrans = Htrans::find($id);
        if (!$htrans) {
            return redirect()->route('checkout.index')->with('error', 'Nota tidak ditemukan.');
        }
    
        // Ambil data transaksi detail
        $dtrans = Dtrans::where('htrans_id', $id)->get();
    
        // Kirim data ke view nota
        return view('customer.nota', compact('htrans', 'dtrans'));
    }
    

}
