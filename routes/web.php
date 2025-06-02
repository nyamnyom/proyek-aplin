<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\WebController;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Kasir;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Login Register
Route::get('/login', [WebController::class, 'login']);
Route::get('/logout', [WebController::class, 'logout']);
Route::post('/validation', [WebController::class, 'validation']);


// Customer
Route::get('/', [CustomerController::class, 'home']);
Route::get('/Customer/Dine-in', [CustomerController::class, 'dineIn']);
Route::get('/Customer/Take-away', [CustomerController::class, 'takeAway']);
Route::get('/Checkout', [CustomerController::class, 'checkout']);
Route::post('/add-to-cart/{id}', [CustomerController::class, 'addToCart']);
Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
Route::post('/checkout/update', [CustomerController::class, 'updateCart'])->name('checkout.update');
Route::post('/checkout/process', [CustomerController::class, 'processCheckout'])->name('checkout.process');
Route::get('/Customer/nota/{id}', [CustomerController::class, 'nota'])->name('checkout.nota');
Route::get('/weather/{city}', [CustomerController::class, 'getWeather']);


// Admin
Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/daftar-event', [AdminController::class, 'daftar_event']);
Route::get('/manajemen-menu', [AdminController::class, 'manajemen_menu']);
Route::get('/manajemen-pegawai', [AdminController::class, 'manajemen_pegawai']);
Route::get('/riwayat-penjualan', [AdminController::class, 'riwayat_penjualan']);


// Get Data Page Admin
Route::get('/user', [AdminController::class, 'get_all_user']);
Route::get('/shift', [AdminController::class, 'get_shift']);
Route::post('/shift', [AdminController::class, 'add_shift']);
Route::post('/user/update', [AdminController::class, 'update_user']);
Route::post('/shift/deleteByUser/{id}', [AdminController::class, 'deleteByUser'])->name('shift.deleteByUser');
Route::post('/shift/update', [AdminController::class, 'update_shift']);
Route::get('/promo', [AdminController::class, 'get_all_promo']);
Route::post('/promo', [AdminController::class, 'add_promo']);
Route::put('/promo/{id}', [AdminController::class, 'update_promo'])->name('promo.update');
Route::post('/user', [AdminController::class, 'add_user']);
Route::get('/menu', [AdminController::class, 'get_menu']);
Route::get('/dtrans', [AdminController::class, 'getDtrans']);
Route::get('/htrans', [AdminController::class, 'getHtrans']);
Route::get('/transaction', [AdminController::class, 'getTransaction']);

// CRUD Admin
Route::post('/insertMenu', [AdminController::class, 'insertMenu']);
Route::post('/updateMenu/{id}', [AdminController::class, 'updateMenu']);
Route::post('/deleteMenu/{id}', [AdminController::class, 'deleteMenu']);


// Kasir
Route::get('/daftar-pesanan', [KasirController::class, 'daftar_pesanan']);
Route::get('/payment-system', [KasirController::class, 'payment_system'])->name('payment.system');
// Route::post('/checkout', [KasirController::class, 'checkout']);
Route::get('/kasir-main', [KasirController::class, 'kasir_main']);
Route::get('/reservasi-meja', [KasirController::class, 'reservasi_meja']);

Route::post('/insertTransaction', [KasirController::class, 'insertTransaction']);
Route::post('/siap-saji/{id}', [KasirController::class, 'updateStatusPesanan']);
Route::get('/cek-kode-promo', [KasirController::class, 'cekKodePromo']);

Route::post('/insert-reservasi', [KasirController::class, 'insert_reservasi'])->name('kasir.insertReservasi');
Route::post('/kasir/reservasi/update', [KasirController::class, 'updateReservasi'])->name('kasir.updateReservasi');
Route::get('/kasir/reservasi/delete/{id}', [KasirController::class, 'deleteReservasi'])->name('kasir.deleteReservasi');

// ini yang baru 
Route::post('/set-session-order', [KasirController::class, 'setSessionOrder'])->name('kasir.setSessionOrder');
Route::get('/Kasir/nota/{id}', [KasirController::class, 'nota'])->name('Kasir.nota');
Route::post('/payment-system', [KasirController::class, 'insertTransaction'])->name('payment.submit');


