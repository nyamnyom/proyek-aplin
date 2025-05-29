@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Sistem Kasir (Pembayaran)')

@section('content')
<div class="row mx-0">
    <!-- Detail Pesanan -->
    <div class="col-md-6">
        <div class="main-content" style="height: 82vh; overflow-y: auto;">
            <h4 class="mb-4">Detail Pesanan</h4>
            <div class="order-items">
                @php $subtotal = 0; @endphp
                @foreach ($items as $item)
                    @php $itemTotal = $item['qty'] * $item['price']; $subtotal += $itemTotal; @endphp
                    <div class="mb-3 border-bottom pb-2">
                        <strong>{{ $item['name'] }}</strong><br>
                        <div class="text-muted small">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                        <div class="small">Catatan: {{ $item['note'] ?? '-' }}</div>
                        <div class="item-qty">{{ $item['qty'] }}</div>
                        <div class="text-end mt-2 fw-bold">Rp {{ number_format($itemTotal, 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-between mt-4 fw-bold">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Pembayaran -->
    <div class="col-md-6 mb-5">
        <div class="main-content" style="height: 82vh; overflow-y: auto">
            <h4 class="mb-4">Pembayaran</h4>
            <div class="mb-3">
                <label class="form-label small">Metode Pembayaran</label>
                <div class="payment-method-container d-flex gap-2">
                    @foreach(['Cash', 'QRIS', 'Bank'] as $method)
                        <div class="payment-method {{ $loop->first ? 'active' : '' }}">
                            <div class="text-center">
                                <i class="fas {{ $loop->index == 0 ? 'fa-money-bill-wave' : ($loop->index == 1 ? 'fa-credit-card' : 'fa-building-columns') }} fa-2x"></i>
                                <div class="small mt-1">{{ $method }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="paymentAmount" class="form-label small">Jumlah Pembayaran (Cash)</label>
                <input type="text" class="form-control" id="paymentAmount" value="0">
            </div>
            <div class="mb-3">
                <label for="kodePromo" class="form-label small">Kode Promo</label>
                <input type="text" class="form-control" id="kodePromo">
                <div id="promo-feedback" class="form-text text-danger"></div>
            </div>

            <div class="mb-3 d-flex justify-content-between fw-bold" id="change-container" style="display: none;">
                <span>Kembalian</span>
                <span id="change-display">Rp 0</span>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <span class="fw-bold">Total</span>
                <span class="fw-bold" id="total-display">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button class="cancel-btn me-2 btn btn-secondary">Cancel</button>
                <button class="confirm-btn btn btn-primary">Selesaikan Pembayaran</button>
            </div>
        </div>
    </div>
</div>

<form id="payment-form" method="POST" action="{{ route('payment.submit') }}">
    @csrf
    <input type="hidden" name="payment_method" id="input-payment-method">
    <input type="hidden" name="total" id="input-total">
    <input type="hidden" name="kode_promo" id="input-kode-promo">
    <div id="dtrans-inputs">
        @foreach ($items as $index => $item)
            <input type="hidden" name="items[{{ $index }}][item_name]" value="{{ $item['name'] }}">
            <input type="hidden" name="items[{{ $index }}][qty]" value="{{ $item['qty'] }}">
            <input type="hidden" name="items[{{ $index }}][price]" value="{{ $item['price'] }}">
            <input type="hidden" name="items[{{ $index }}][subtotal]" value="{{ $item['qty'] * $item['price'] }}">
        @endforeach
    </div>
</form>
@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentMethods = document.querySelectorAll('.payment-method');
        const paymentInputContainer = document.getElementById('paymentAmount').closest('.mb-3');
        const paymentInput = document.getElementById('paymentAmount');
        const changeContainer = document.getElementById('change-container');
        const changeDisplay = document.getElementById('change-display');
        const totalDisplay = document.getElementById('total-display');
        const total = parseInt(totalDisplay.textContent.replace(/\D/g, ''));

        function updatePaymentInputVisibility(methodName) {
            if (methodName === 'Cash') {
                paymentInputContainer.style.display = 'block';
                changeContainer.style.display = 'block';
            } else {
                paymentInputContainer.style.display = 'none';
                changeContainer.style.display = 'none';
                paymentInput.value = '0';
                changeDisplay.textContent = 'Rp 0';
            }
        }

        function updateChangeDisplay() {
            const paid = parseInt(paymentInput.value.replace(/\./g, '')) || 0;
            const change = paid - total;
            if (change > 0) {
                changeDisplay.textContent = 'Rp ' + change.toLocaleString('id-ID');
            } else {
                changeDisplay.textContent = 'Rp 0';
            }
        }

        // Inisialisasi
        updatePaymentInputVisibility('Cash');
        updateChangeDisplay();

        // Event pilih metode pembayaran
        paymentMethods.forEach(method => {
            method.addEventListener('click', () => {
                paymentMethods.forEach(m => m.classList.remove('active'));
                method.classList.add('active');

                const methodName = method.querySelector('.small').textContent;
                document.querySelector('label[for="paymentAmount"]').textContent = `Jumlah Pembayaran (${methodName})`;
                updatePaymentInputVisibility(methodName);
            });
        });

        // Format input dan hitung kembalian
        paymentInput.addEventListener('input', function () {
            let value = this.value.replace(/[^\d]/g, '');
            this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            updateChangeDisplay();
        });

        // Tombol konfirmasi
        document.querySelector('.confirm-btn').addEventListener('click', function () {
            const activeMethod = document.querySelector('.payment-method.active .small').textContent;
            const paid = activeMethod === 'Cash' ? (parseInt(paymentInput.value.replace(/\./g, '')) || 0) : total;

            const confirmBtn = document.querySelector('.confirm-btn');

            // Ambil nilai jumlah item dari Blade
            const itemCount = {{ count($items) }};
            if (itemCount === 0) {
                return alert('Tidak ada pesanan yang dipilih!');
            }

            if (paid < total) {
                return alert('Jumlah pembayaran kurang dari total tagihan!');
            }
            
            const kodePromos = document.getElementById('promo-feedback').textContent;
            if (kodePromos != "") {
                return alert('Kode promo tidak ditemukan');
            }


            document.getElementById('input-payment-method').value = activeMethod;
            document.getElementById('input-total').value = total;
            document.getElementById('input-kode-promo').value = document.getElementById('kodePromo').value;
            document.getElementById('payment-form').submit();
        });

        // Tombol batal
        document.querySelector('.cancel-btn').addEventListener('click', () => {
            if (confirm('Yakin ingin membatalkan pembayaran?')) {
                window.location.href = 'kasir-main'; // Ganti dengan URL halaman sebenarnya
            }
        });

        document.getElementById('kodePromo').addEventListener('input', function () {
            const kode = this.value;
            if (kode.length === 0) {
                document.getElementById('promo-feedback').innerText = '';
                return;
            }

            fetch(`/cek-kode-promo?kode=${kode}`)
            .then(response => response.json())
            .then(data => {
                const feedback = document.getElementById('promo-feedback');
                if (data.exists) {
                    feedback.innerText = '';
                } else {
                    feedback.innerText = 'Kode promo tidak ditemukan';
                }
            })
            .catch(err => {
                console.error('Gagal cek promo:', err);
            });
        });
    });
</script>

@endsection