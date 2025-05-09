@extends('Customer.layouts.app')

@section('title', 'Nota Transaksi')

@section('content')
<div class="container">
    <h2>Nota  #{{ $htrans->id }}</h2>
    <p>Metode Pembayaran: {{ $htrans->payment_method }}</p>
    @if($htrans->payment_method == 'cash')
            <b>Catatan:</b> Silahkan berikan nota ini kepada kasir untuk proses pembayaran lebih lanjut.

    @endif
    

    

    <hr>
    <h4>Detail Pesanan:</h4>
    <ul>
        @foreach ($dtrans as $item)
            {{ $item->item_name }} - {{ $item->qty }} x Rp{{ number_format($item->price) }} = Rp{{ number_format($item->subtotal) }}<br>
        @endforeach
    </ul>
    <p>Total: Rp{{ number_format($htrans->total) }}</p>
    <hr>
    <a href="/" class="btn btn-primary">Kembali ke Dine-In</a>
</div>
@endsection
