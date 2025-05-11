<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Restoran Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Define Custom Colors */
        :root {
            --primary-color: #8B0000;
            --secondary-color: #D32F2F;
            --text-light: #FFFFFF;
            --text-dark: #333333;
            --bg-gray: #F5F5F5;
        }

        body {
            background-color: var(--bg-gray);
        }

        .checkout-card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            background-color: var(--text-light);
        }

        .quantity-input {
            width: 80px;
            margin-left: 15px;
        }

        .total-section {
            font-size: 18px;
        }

        .payment-methods {
            margin-top: 20px;
        }

        .payment-title {
            font-size: 18px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .payment-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .payment-option {
            border: 1px solid #ddd;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            flex: 1;
            min-width: 120px;
            text-align: center;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .payment-option.selected {
            border-color: var(--secondary-color);
            background-color: rgba(204, 3, 3); /* Lighter shade of secondary color */
            color: white
        }

        .payment-option:hover {
            background-color: var(--secondary-color);
            color: var(--text-light);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-success {
            background-color: #388E3C;
            border-color: #388E3C;
        }

        .btn-success:hover {
            background-color: #2C6E2F;
            border-color: #2C6E2F;
        }

        .text-dark {
            color: var(--text-dark);
        }
        .quantity-control {
    max-width: 140px;
}
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Checkout</h2>
            <a href="/Customer/Dine-in" class="btn btn-outline-secondary">&larr; Kembali ke Menu</a>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
        <div class="card checkout-card p-4">
            <h5 class="mb-3 text-dark">Daftar Pesanan</h5>
            <form action="/checkout/update" method="POST">
                @csrf
                <ul class="list-group mb-4">
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $key => $item)
                        @php $total += $item['price'] * $item['qty']; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item['name'] }}</strong><br>
                                <small>{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                            </div>
                            <span>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                            <div>
                                <div class="input-group quantity-control">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="updateQty('{{ $key }}', -1)">−</button>
                                    <input type="text" id="qty-{{ $key }}" name="cart[{{ $key }}][qty]" class="form-control text-center" value="{{ $item['qty'] }}" readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="updateQty('{{ $key }}', 1)">+</button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="total-section d-flex justify-content-between">
                    <strong>Total Pembayaran:</strong>
                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </div>

                <div class="payment-methods">
                    <h3 class="payment-title">Metode Pembayaran</h3>
                    <div class="payment-options">
                        <div class="payment-option selected" onclick="selectPaymentMethod(this)">Cash</div>
                        <div class="payment-option" onclick="selectPaymentMethod(this)">Debit Card</div>
                        <div class="payment-option" onclick="selectPaymentMethod(this)">QRIS</div>
                        
                    </div>
                </div>

               


                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Perbarui Pesanan</button>
                </div>
            </form>

            <!-- Button Proses Pembayaran -->
            
      <h5>Metode Pembayaran</h5>
      
      <form id="paymentForm" action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <input type="hidden" id="payment_method" name="payment_method" value="cash">
        <button class="btn btn-success">Proses Pembayaran</button>
      </form>
    </div>
        </div>
        @else
        <div class="alert alert-warning">
            Belum ada pesanan. Silakan kembali dan tambahkan item terlebih dahulu.
        </div>
        @endif
    </div>

    <script>

function updateQty(key, change) {
    const input = document.getElementById('qty-' + key);
    let currentValue = parseInt(input.value) || 1;
    let newValue = currentValue + change;
    if (newValue < 1) newValue = 1; // Set ke 1 jika kurang dari 1
    input.value = newValue;
}

        function selectPaymentMethod(element) {
            const paymentOptions = document.querySelectorAll('.payment-option');
            paymentOptions.forEach(option => option.classList.remove('selected'));
            element.classList.add('selected');
            
            // Update hidden input field for selected payment method
            const selectedMethod = element.textContent.trim().toLowerCase().replace(/\s/g, '_');
            document.getElementById('payment_method').value = selectedMethod;
        }
    </script>
</body>
</html>
