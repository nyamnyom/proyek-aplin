<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    function daftar_pesanan(){
        return view('Kasir.daftar-pesanan');
    }
    function payment_system(){
        return view('Kasir.payment-system');
    }
    function kasir_main(){
        $foods = DB::table('menus')->where('is_active', true)->where('category', "Makanan")->get();
        $drinks = DB::table('menus')->where('is_active', true)->where('category', "Minuman")->get();
        $rekomendasi = DB::table('menus')->where('is_active', true)->orderBy('total_ordered', 'desc')->get();
        return view('Kasir.kasir-main', ['foods' => $foods, 'drinks' => $drinks, 'rekomendasi' => $rekomendasi]);

    }
    function reservasi_meja(){
        return view('Kasir.reservasi-meja');
    }
}
