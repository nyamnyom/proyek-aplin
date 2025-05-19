@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Sistem Kasir (Pembayaran)')

@section('content')
<div class="row mx-0">
        <!-- Pesanan Section -->
        <div class="col-md-6">
            <div class="main-content" style="height: 82vh; overflow-y: auto;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Detail Pesanan</h4>
                </div>
                
                <div class="mb-4">
                    <div class="order-items">
                        @foreach ($items as $item)
                            <div>
                                <strong class="fw-bold">{{ $item['name'] }}</strong><br>
                                <div class="text-muted small">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                <div class="mb-2">Catatan: {{ $item['note'] ?? '-' }}</div>
                                <div class="form-control item-qty">{{ $item['qty'] }}</div>
                                <div class="text-end mt-2">Total: <span class="item-total fw-bold">Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}</span></div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            @php
                                $subtotal = 0;
                                foreach ($items as $item) {
                                    $subtotal += $item['qty'] * $item['price'];
                                }
                            @endphp
                            <span class="fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pembayaran Section -->
        <div class="col-md-6 mb-5">
            <div class="main-content" style="height: 82vh; overflow-y: auto">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Pembayaran</h4>
                </div>
                
                <div class="payment-details mt-4">
                    <h6 class="mb-3">Rincian Pembayaran</h6>
                    
                    <div class="mb-3">
                        <label class="form-label small">Payment Method</label>
                        <div class="payment-method-container">
                            <div class="payment-method active">
                                <div class="text-center">
                                    <i class="fas fa-money-bill-wave fa-2x"></i>
                                </div>
                                <div class="small mt-1">Cash</div>
                            </div>
                            <div class="payment-method">
                                <div class="text-center">
                                    <i class="fas fa-credit-card fa-2x"></i>
                                </div>
                                <div class="small mt-1">QRIS</div>
                            </div>
                            <div class="payment-method">
                                <div class="text-center">
                                    <i class="fas fa-building-columns fa-2x"></i>
                                </div>
                                <div class="small mt-1">Bank</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label small">Jumlah Pembayaran (Cash)</label>
                        <input type="text" class="form-control" id="paymentAmount" value="0">
                    </div>
                </div>
                
                <div class="payment-summary">
                    <div class="payment-summary">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Diterima</span>
                        <span>Rp 250.000</span>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button class="cancel-btn me-2">Cancel</button>
                    <a href=""><button class="confirm-btn">Selesaikan Pembayaran</button></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hidden input untuk data transaksi -->
        <form id="payment-form">
            @csrf
            <!-- Untuk HTRANS -->
            <input type="hidden" name="payment_method" id="input-payment-method">
            <input type="hidden" name="total" id="input-total">

            <!-- Untuk DTRANS, akan diisi dengan JavaScript -->
            <div id="dtrans-inputs"></div>
        </form>
                
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Fungsionalitas untuk metode pembayaran
        const paymentMethods = document.querySelectorAll('.payment-method');
        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                paymentMethods.forEach(m => {
                    m.classList.remove('active');
                });
                this.classList.add('active');
                
                // Ganti label untuk input jumlah pembayaran sesuai metode
                const methodName = this.querySelector('.small').textContent;
                document.querySelector('label[for="paymentAmount"]').textContent = `Jumlah Pembayaran (${methodName})`;
            });
        });
        
        // Fungsionalitas untuk input jumlah pembayaran
        const paymentAmountInput = document.getElementById('paymentAmount');
        paymentAmountInput.addEventListener('input', function() {
            // Hapus karakter non-angka
            let value = this.value.replace(/[^\d]/g, '');
            
            // Format dengan titik setiap 3 digit
            if (value.length > 3) {
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            
            this.value = value;
        });
        
        // Fungsionalitas untuk input jumlah
        const qtyInputs = document.querySelectorAll('.item-qty');
        qtyInputs.forEach(input => {
            input.addEventListener('change', function() {
                updateItemTotal(this);
                updateSubtotal();
            });
        });
        
        // Fungsi untuk mengupdate total per item
        function updateItemTotal(qtyInput) {
            const orderItem = qtyInput.closest('.order-item');
            const priceText = orderItem.querySelector('.text-muted.small').textContent;
            const price = parseInt(priceText.replace(/\D/g, ''));
            const qty = parseInt(qtyInput.value) || 0;
            const totalPrice = price * qty;
            
            orderItem.querySelector('div[style*="text-align: right"] span').textContent = 
                `Rp ${totalPrice.toLocaleString('id-ID')}`;
        }
        
        // Fungsi untuk mengupdate subtotal
        function updateSubtotal() {
            let subtotal = 0;
            if (document.querySelector('.order-items') === null) {
                return;
            }
            document.querySelectorAll('.order-item').forEach(item => {
                const totalText = item.querySelector('div[style*="text-align: right"] span').textContent;
                const total = parseInt(totalText.replace(/\D/g, '')) || 0;
                subtotal += total;
            });
            
            document.querySelector('.d-flex.justify-content-between.mb-2 .fw-bold').textContent = 
                `Rp ${subtotal.toLocaleString('id-ID')}`;
            
            // Update juga total di payment summary
            document.querySelector('.payment-summary .d-flex.justify-content-between:first-child span:last-child').textContent = 
                `Rp ${subtotal.toLocaleString('id-ID')}`;
            
            // Update total keseluruhan
           const grandTotal = subtotal;
            
            document.querySelector('.payment-summary .d-flex.justify-content-between:last-child span:last-child').textContent = 
                `Rp ${grandTotal.toLocaleString('id-ID')}`;
            
            // Trigger pembayaran untuk update kembalian
            const paymentEvent = new Event('input');
            document.getElementById('paymentAmount').dispatchEvent(paymentEvent);
        }
        
        // Fungsionalitas untuk tombol Selesaikan Pembayaran
        document.querySelector('.confirm-btn').addEventListener('click', function() {
            // Validasi data pembayaran
            const paymentAmount = parseInt(document.getElementById('paymentAmount').value.replace(/\./g, '')) || 0;
            const total = parseInt(document.querySelector('.payment-summary .d-flex.justify-content-between:last-child span:last-child').textContent.replace(/\D/g, '')) || 0;
            
            if (paymentAmount < total) {
                alert('Jumlah pembayaran kurang dari total tagihan!');
                return;
            }
            
            // Ambil metode pembayaran aktif
            const selectedMethod = document.querySelector('.payment-method.active .small').textContent;
            document.getElementById('input-payment-method').value = selectedMethod;

            // Ambil total
            document.getElementById('input-total').value = total;

            // Ambil semua item dan masukkan sebagai hidden input
            const dtransInputsContainer = document.getElementById('dtrans-inputs');
            dtransInputsContainer.innerHTML = ''; // Kosongkan dulu

            document.querySelectorAll('.order-item').forEach((item, index) => {
            const itemName = item.querySelector('.fw-bold').textContent.trim();
            const qty = item.querySelector('.item-qty').value;
            const priceText = item.querySelector('.text-muted.small').textContent;
            const price = parseInt(priceText.replace(/\D/g, '')) || 0;
            const subtotal = qty * price;

            dtransInputsContainer.innerHTML += `
            <input type="hidden" name="items[${index}][item_name]" value="${itemName}">
            <input type="hidden" name="items[${index}][qty]" value="${qty}">
            <input type="hidden" name="items[${index}][price]" value="${price}">
            <input type="hidden" name="items[${index}][subtotal]" value="${subtotal}">
            `;
            });

            document.getElementById('payment-form').submit();
        });
        
        // Fungsionalitas untuk tombol Cancel
        document.querySelector('.cancel-btn').addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?')) {
                window.location.reload();
            }
        });
        
        // Inisialisasi item total
        qtyInputs.forEach(input => {
            updateItemTotal(input);
        });
        updateSubtotal();
    });
</script>
@endsection