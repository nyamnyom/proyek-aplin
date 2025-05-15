<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\WebController;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Login Register
Route::get('/login', [WebController::class, 'login']);
Route::get('/register', [WebController::class, 'register']);


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
Route::get('/edit-bahan', [AdminController::class, 'edit_bahan']);
Route::get('/inventaris', [AdminController::class, 'inventaris']);
Route::get('/manajemen-menu', [AdminController::class, 'manajemen_menu']);
Route::get('/manajemen-pegawai', [AdminController::class, 'manajemen_pegawai']);
Route::get('/riwayat-penjualan', [AdminController::class, 'riwayat_penjualan']);
Route::get('/tambah-bahan', [AdminController::class, 'tambah_bahan']);

// Get Data Page Admin
Route::get('/user', [AdminController::class, 'get_all_user']);
Route::get('/promo', [AdminController::class, 'get_all_promo']);
Route::post('/promo', [AdminController::class, 'add_promo']);
Route::post('/user', [AdminController::class, 'add_user']);
Route::get('/dtrans', [AdminController::class, 'getDtrans']);
Route::get('/htrans', [AdminController::class, 'getHtrans']);
Route::get('/transaction', [AdminController::class, 'getTransaction']);

// CRUD Admin
Route::post('/insertMenu', [AdminController::class, 'insertMenu']);
Route::post('/updateMenu/{id}', [AdminController::class, 'updateMenu']);
Route::post('/deleteMenu/{id}', [AdminController::class, 'deleteMenu']);


// Kasir
Route::get('/daftar-pesanan', [KasirController::class, 'daftar_pesanan']);
Route::get('/payment-system', [KasirController::class, 'payment_system']);
Route::get('/kasir-main', [KasirController::class, 'kasir_main']);
Route::get('/reservasi-meja', [KasirController::class, 'reservasi_meja']);
