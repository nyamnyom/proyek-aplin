<!-- resources/views/checkout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Restoran Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .checkout-card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">Checkout</h2>
            <a href="Customer/Dine-in" class="btn btn-outline-secondary">&larr; Kembali ke Menu</a>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
        <div class="card checkout-card p-4 mb-4">
            <h5 class="mb-3">Daftar Pesanan:</h5>
            <ul class="list-group mb-3">
                @php $total = 0; @endphp
                @foreach(session('cart') as $item)
                    @php $total += $item['price'] * $item['qty']; @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $item['name'] }}</strong><br>
                            <small>{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                        </div>
                        <span>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="d-flex justify-content-between">
                <strong>Total</strong>
                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>

            <div class="text-end mt-4">
                <form action="/checkout/process" method="POST">
                    @csrf
                    <button class="btn btn-success btn-lg">Proses Pembayaran</button>
                </form>
            </div>
        </div>
        @else
        <div class="alert alert-warning">
            Belum ada pesanan. Silakan kembali dan tambahkan item terlebih dahulu.
        </div>
        @endif
    </div>
</body>
</html>
