<?php

namespace App\Http\Controllers;

class KasirController extends Controller
{
    function daftar_pesanan(){
        return view('Kasir.daftar-pesanan');
    }
    function payment_system(){
        return view('Kasir.payment-system');
    }
    function kasir_main(){
        return view('Kasir.kasir-main');
    }
    function reservasi_meja(){
        return view('Kasir.reservasi-meja');
    }
}
