<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan QR Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light text-center py-5">
    <h2 class="text-success mb-3">Silakan Scan QR di Bawah Ini</h2>
    <p>Order ID: <strong>{{ $order_id }}</strong></p>
    <p>Total: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></p>

    <iframe src="{{ $qrUrl }}" width="400" height="400" frameborder="0"></iframe>

    <div class="mt-4">
        <a href="/Customer/Dine-in" class="btn btn-primary">Kembali ke Menu</a>
    </div>
</body>
</html>
