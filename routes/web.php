<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Customer
Route::get('/', function () {
    return view('Customer/Customer');
});

Route::get('/Customer/Dine-in', function() {
    $menus = DB::table('menus')->where('is_active', true)->get();
    return view('Customer/Dine-in', ['menus' => $menus]);
});

Route::get('/Checkout', function () {
    return view('Customer/Checkout');
});

Route::post('/add-to-cart/{id}', function ($id) {
    // Mendapatkan menu berdasarkan ID
    $menu = DB::table('menus')->where('id', $id)->first();

    // Cek apakah menu ada
    if ($menu) {
        // Membuat array item cart
        $item = [
            'id' => $menu->id,
            'name' => $menu->name,
            'price' => $menu->price,
            'qty' => 1, // Quantity default 1
        ];

        // Cek apakah sudah ada cart di session
        $cart = session()->get('cart', []);

        // Cek apakah item sudah ada di cart
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['id'] === $item['id']) {
                $cartItem['qty'] += 1; // Increment quantity
                $found = true;
                break;
            }
        }

        // Jika item belum ada, tambahkan ke cart
        if (!$found) {
            $cart[] = $item;
        }

        // Simpan kembali cart ke session
        session()->put('cart', $cart);
    }

    // Redirect kembali ke halaman dine-in
    return redirect('Customer/Dine-in');
});

Route::post('/checkout/process', function () {
    // Ambil data cart dari session
    $cart = session()->get('cart', []);

    // Pastikan cart tidak kosong
    if (empty($cart)) {
        return redirect('/dine-in')->with('error', 'Cart kosong, silakan tambahkan item terlebih dahulu');
    }

    // Proses pembayaran dan clear cart
    // Di sini, kamu bisa menambahkan logika untuk menyimpan transaksi, misalnya ke database
    // Setelah itu, kita bersihkan cart
    session()->forget('cart');

    // Redirect ke halaman konfirmasi pembayaran atau selesai
    return redirect('/')->with('success', 'Pembayaran berhasil, terima kasih!');
});


// Admin
Route::get('/dashboard', [AdminController::class, 'dashboard']);