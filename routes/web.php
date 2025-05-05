<?php

use Illuminate\Support\Facades\Route;

Route::get('/Customer', function () {
    return view('Customer/Customer');
});

Route::get('/Admin', function () {
    return view('Admin/Admin');
});
