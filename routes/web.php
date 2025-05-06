<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\CustomerController;

Route::get('/', [CustomerController::class, 'home']);
Route::get('/Customer/Dine-in', [CustomerController::class, 'dineIn']);
Route::get('/Checkout', [CustomerController::class, 'checkout']);
Route::post('/add-to-cart/{id}', [CustomerController::class, 'addToCart']);
Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
Route::post('/checkout/update', [CustomerController::class, 'updateCart'])->name('checkout.update');
Route::post('/checkout/process', [CustomerController::class, 'processCheckout'])->name('checkout.process');
// Admin
Route::get('/dashboard', [AdminController::class, 'dashboard']);