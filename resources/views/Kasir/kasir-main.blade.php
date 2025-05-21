@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Sistem Kasir')

@section('content')
    <div class="row mx-0" style="display: flex; flex-wrap: nowrap;">
        <!-- Menu Section -->
        <div class="col-md-7 main-content p-4" style="overflow-y: auto; height: 82vh;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Tambah Pesanan</h4>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <ul class="nav nav-tabs category-tab" id="menuTabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#makanan">Makanan Berat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#minuman">Minuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#rekomendasi">Rekomendasi</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="makanan">
                            <div class="row">
                                @if ($foods->isEmpty())
                                    <div class="alert alert-info">Makanan tidak ditemukan</div>
                                @else
                                    @foreach ($foods as $food)
                                        <div class="col-md-4">
                                            <div class="menu-card">
                                                <div class="menu-image">
                                                    <img src="{{ asset($food->image_url) }}" alt="{{ $food->name }}" onerror="this.onerror=null;this.src='{{ asset('default_food.png') }}';">
                                                </div>
                                                <div class="menu-details">
                                                    <div class="menu-title">{{ $food->name }}</div>
                                                    <div class="menu-price">Rp {{ number_format($food->price, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="minuman">
                            <div class="row">
                                @if ($drinks->isEmpty())
                                    <div class="alert alert-info">Minuman tidak ditemukan</div>
                                @else
                                    @foreach ($drinks as $drink)
                                        <div class="col-md-4">
                                            <div class="menu-card">
                                                <div class="menu-image">
                                                    <img src="{{ asset($drink->image_url) }}" alt="{{ $drink->name }}" onerror="this.onerror=null;this.src='{{ asset('default_food.png') }}';">
                                                </div>
                                                <div class="menu-details">
                                                    <div class="menu-title">{{ $drink->name }}</div>
                                                    <div class="menu-price">Rp {{ number_format($drink->price, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="rekomendasi">
                            <div class="row">
                                @if ($rekomendasi->isEmpty())
                                    <div class="alert alert-info">Belum ada menu rekomendasi</div>
                                @else
                                    @foreach ($rekomendasi as $item)
                                        <div class="col-md-4">
                                            <div class="menu-card">
                                                <div class="menu-image">
                                                    <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" onerror="this.onerror=null;this.src='{{ asset('default_food.png') }}';">
                                                </div>
                                                <div class="menu-details">
                                                    <div class="menu-title">{{ $item->name }}</div>
                                                    <div class="menu-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                                    <div class="menu-category">
                                                        <span class="badge bg-success">Populer</span>
                                                        <span class="text-muted small">{{ $item->total_ordered }} terjual</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Section -->
        <div class="col-md-5 p-4 bg-light">
            <div class="order-section me-5" style="height: 82vh">
                <div class="order-header">
                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <div>Menu</div>
                        <div class="d-flex">
                            <div style="width: 50px; text-align: center;">Qty</div>
                            <div style="width: 100px; text-align: right;">Harga</div>
                        </div>
                    </div>
                </div>

                <div class="order-items"></div>

                <div class="order-summary">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="text-muted">Subtotal</div>
                        <div class="fw-bold">Rp 0</div>
                    </div>
                    <button class="checkout-btn" id="checkoutBtn">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuCards = document.querySelectorAll('.menu-card');
        menuCards.forEach(card => {
            card.addEventListener('click', function() {
                const menuTitle = this.querySelector('.menu-title').textContent;
                const menuPrice = this.querySelector('.menu-price').textContent;
                const menuImage = this.querySelector('.menu-image img').src;

                const orderItems = document.querySelectorAll('.order-item');
                let itemExists = false;

                orderItems.forEach(item => {
                    const itemTitle = item.querySelector('.fw-bold').textContent;
                    if (itemTitle === menuTitle) {
                        const qtyInput = item.querySelector('.item-qty');
                        let currentQty = parseInt(qtyInput.value);
                        qtyInput.value = currentQty + 1;

                        const price = parseInt(menuPrice.replace(/\D/g, ''));
                        const totalPrice = price * (currentQty + 1);
                        item.querySelector('.text-end.ms-3').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                        itemExists = true;
                    }
                });

                if (!itemExists) {
                    const price = parseInt(menuPrice.replace(/\D/g, ''));
                    const newOrderItem = `
                        <div class="order-item">
                            <div class="d-flex">
                                <img src="${menuImage}" alt="Menu" class="item-img me-3">
                                <div class="flex-grow-1">
                                    <div class="fw-bold">${menuTitle}</div>
                                    <div class="text-muted small">${menuPrice}</div>
                                    <input type="text" class="note-input" placeholder="Order Note...">
                                </div>
                                <div class="d-flex align-items-center ms-3">
                                    <input type="number" class="item-qty" value="1" min="1">
                                    <div class="text-end ms-3" style="width: 80px;">${menuPrice}</div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <button class="delete-btn"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    `;

                    const orderItemsContainer = document.querySelector('.order-items');
                    orderItemsContainer.insertAdjacentHTML('beforeend', newOrderItem);

                    const newItem = orderItemsContainer.lastElementChild;

                    newItem.querySelector('.delete-btn').addEventListener('click', function() {
                        this.closest('.order-item').remove();
                        updateOrderSummary();
                    });

                    newItem.querySelector('.item-qty').addEventListener('change', function() {
                        updateItemTotal(this);
                    });
                }

                updateOrderSummary();
            });
        });

        function updateItemTotal(qtyInput) {
            const orderItem = qtyInput.closest('.order-item');
            const priceText = orderItem.querySelector('.text-muted.small').textContent;
            const price = parseInt(priceText.replace(/\D/g, ''));
            const qty = Math.max(parseInt(qtyInput.value), 1);
            qtyInput.value = qty;
            const totalPrice = price * qty;
            orderItem.querySelector('.text-end.ms-3').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
            updateOrderSummary();
        }

        function updateOrderSummary() {
            let subtotal = 0;
            document.querySelectorAll('.order-item').forEach(item => {
                const priceText = item.querySelector('.text-end.ms-3').textContent;
                const price = parseInt(priceText.replace(/\D/g, ''));
                subtotal += price;
            });
            document.querySelector('.order-summary .fw-bold').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
        }


        document.getElementById('checkoutBtn').addEventListener('click', function () {
            const orderData = [];
            
            document.querySelectorAll('.order-item').forEach(item => {
                const name = item.querySelector('.fw-bold').textContent;
                const note = item.querySelector('.note-input')?.value || '';
                const qty = parseInt(item.querySelector('.item-qty').value);
                const priceText = item.querySelector('.text-muted.small').textContent;
                const price = parseInt(priceText.replace(/\D/g, ''));

                orderData.push({
                    name,
                    note,
                    qty,
                    price
                });
            });

            fetch('/set-session-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ order_items: orderData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/payment-system";
                } else {
                    alert('Gagal menyimpan pesanan ke session');
                }
            });
        });

    });
</script>
@endsection
