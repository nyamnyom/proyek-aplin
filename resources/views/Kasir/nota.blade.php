@extends('Customer.layouts.app')

@section('title','Nota Transaksi')

@section('content')
<div class="container py-5">
    <h2>Nota #{{ $htrans->id }}</h2>
    <p><strong>Metode Pembayaran:</strong> {{ strtoupper($htrans->payment_method) }}</p>

    @if($htrans->payment_method === 'cash')
        <div class="alert alert-info">Silakan tunjukkan nota ini ke kasir untuk menyelesaikan pembayaran.</div>
    @elseif($htrans->payment_method === 'debit_card')
        <div class="alert alert-info">Pembayaran via kartu debit diproses menggunakan mesin EDC.</div>
    @elseif($htrans->payment_method === 'QRIS' && isset($qrUrl))
        <div class="text-center my-4">
            <h5>Silakan scan QR berikut untuk melakukan pembayaran:</h5>
           
            <img src="{{ $qrUrl }}" alt="QR Pembayaran" width="250">
        </div>
    @endif
  

    <hr>
    <h4>Detail Pesanan:</h4>
    <ul>
        @foreach ($dtrans as $item)
            <li>{{ $item->item_name }} — {{ $item->qty }} x Rp{{ number_format($item->price, 0, ',', '.') }} = Rp{{ number_format($item->subtotal, 0, ',', '.') }}</li>
        @endforeach
    </ul>

    <p><strong>Total:</strong> Rp{{ number_format($htrans->total, 0, ',', '.') }}</p>

    <hr>
    <a href="{{ url('/daftar-pesanan') }}" class="btn btn-primary">&larr; Kembali ke Menu</a>
</div>
@endsection
