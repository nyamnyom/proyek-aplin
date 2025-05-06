<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Login Register
Route::get('/', [WebController::class, 'login']);
Route::get('/register', [WebController::class, 'register']);


// Customer
Route::get('/home', [CustomerController::class, 'home']);
Route::get('/Customer/Dine-in', [CustomerController::class, 'dineIn']);
Route::get('/Checkout', [CustomerController::class, 'checkout']);
Route::post('/add-to-cart/{id}', [CustomerController::class, 'addToCart']);
Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
Route::post('/checkout/update', [CustomerController::class, 'updateCart'])->name('checkout.update');
Route::post('/checkout/process', [CustomerController::class, 'processCheckout'])->name('checkout.process');

// Admin
Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/daftar-event', [AdminController::class, 'daftar_event']);
Route::get('/edit-bahan', [AdminController::class, 'edit_bahan']);
Route::get('/inventaris', [AdminController::class, 'inventaris']);
Route::get('/manajemen-menu', [AdminController::class, 'manajemen_menu']);
Route::get('/manajemen-pegawai', [AdminController::class, 'manajemen_pegawai']);
Route::get('/riwayat-penjualan', [AdminController::class, 'riwayat_penjualan']);
Route::get('/tambah-bahan', [AdminController::class, 'tambah_bahan']);

// Kasir
Route::get('/daftar-pesanan', [KasirController::class, 'daftar_pesanan']);
Route::get('/payment-system', [KasirController::class, 'payment_system']);
Route::get('/kasir-main', [KasirController::class, 'kasir_main']);
Route::get('/reservasi-meja', [KasirController::class, 'reservasi_meja']);

