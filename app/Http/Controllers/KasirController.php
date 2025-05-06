<?php

namespace App\Http\Controllers;

class KasirController extends Controller
{
    function daftar_pesanan(){
        return view('Kasir.daftar-pesanan');
    }
}
