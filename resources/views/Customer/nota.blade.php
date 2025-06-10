@extends('Customer.layouts.app')

@section('title','Nota Transaksi')

@section('content')
<style>
    .nota-container {
        max-width: 700px;
        margin: auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .nota-container h2 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .nota-container p strong {
        font-weight: 600;
    }

    .qr-section img {
        border: 4px solid #f0f0f0;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .order-details {
        margin-top: 1rem;
        font-family: 'Courier New', Courier, monospace;
        background-color: #fff;
        padding: 1rem;
        border: 1px dashed #999;
    }

    .order-details h4 {
        margin-bottom: 1rem;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid #999;
        padding-bottom: 0.5rem;
    }

    .order-details .order-item {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px dotted #ccc;
        padding: 4px 0;
    }

    .order-details .item-name {
        flex: 2;
    }

    .order-details .item-qty,
    .order-details .item-price,
    .order-details .item-subtotal {
        flex: 1;
        text-align: right;
        white-space: nowrap;
    }

    .order-details .total {
        font-weight: bold;
        text-align: right;
        margin-top: 1rem;
        border-top: 1px solid #000;
        padding-top: 0.5rem;
        font-size: 1.1rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 0.5rem 1.25rem;
        font-size: 1rem;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="nota-container">
    <h2>Nota #{{ $htrans->id }}</h2>
    <p><strong>Metode Pembayaran:</strong> {{ strtoupper($htrans->payment_method) }}</p>

    @if($htrans->payment_method === 'cash')
        <div class="alert alert-info">Silakan tunjukkan nota ini ke kasir untuk menyelesaikan pembayaran.</div>
    @elseif($htrans->payment_method === 'debit_card')
        <div class="alert alert-info">Pembayaran via kartu debit diproses menggunakan mesin EDC.</div>
    @elseif($htrans->payment_method === 'qris' && isset($qrUrl))
        <div class="text-center qr-section my-4">
            <h5>Silakan scan QR berikut untuk melakukan pembayaran:</h5>
            <img src="{{ $qrUrl }}" alt="QR Pembayaran" width="250">
        </div>
    @endif

    <hr>

    <div class="order-details">
        <h4>Detail Pesanan</h4>

        @foreach ($dtrans as $item)
        <div class="order-item">
            <div class="item-name">{{ $item->item_name }}</div>
            <div class="item-qty">{{ $item->qty }}x</div>
            <div class="item-price">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
            <div class="item-subtotal">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</div>
        </div>
        @endforeach

        <div class="total">Total: Rp{{ number_format($htrans->total, 0, ',', '.') }}</div>
    </div>

    <hr>
    <a href="{{ url('/') }}" class="btn btn-primary">&larr; Kembali ke Menu</a>
</div>
@endsection
