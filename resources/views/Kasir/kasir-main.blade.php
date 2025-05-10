@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Sistem Kasir')

@section('content')
    <div class="row mx-0" style="display: flex; flex-wrap: nowrap;">
        <!-- Menu Section -->
        <div class="col-md-8 main-content" style="overflow-y: auto; height: 100vh;margin-right: -20px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Tambah Pesanan</h4>
                <div class="text-muted">
                    <small>Main Menu / Tambah Pesanan</small>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari menu...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <ul class="nav nav-tabs category-tab" id="menuTabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#makanan">Makanan Berat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#minuman">Minuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#camilan">Camilan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#dessert">Dessert</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="makanan">
                            <div class="row">
                                @if ($foods->isEmpty())
                                    <div class="alert alert-info">
                                        Makanan tidak ditemukan
                                    </div>
                                @else
                                    @foreach ($foods as $food)
                                        <div class="col-md-4">
                                            <div class="menu-card">
                                                <div class="menu-image">
                                                    <img src="https://nibble-images.b-cdn.net/nibble/original_images/nasi-campur-babi-di-jakarta-01.jpg" alt="Nasi Semacem Babi">
                                                </div>
                                                <div class="menu-details">
                                                    <div class="menu-title">{{$food->name}}</div>
                                                    <div class="menu-price">Rp {{ number_format($food->price, 0, ',', '.') }}</div>
                                                    <div class="menu-category">21 menit masak</div>
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
                                    <div class="alert alert-info">
                                        Minuman tidak ditemukan
                                    </div>
                                @else
                                    @foreach ($drinks as $drink)
                                        <div class="col-md-4">
                                            <div class="menu-card">
                                                <div class="menu-image">
                                                    <img src="https://nilaigizi.com/assets/images/produk/produk_1578041377.jpg" alt="Es Teh">
                                                </div>
                                                <div class="menu-details">
                                                    <div class="menu-title">{{$drink->name}}</div>
                                                    <div class="menu-price">Rp {{ number_format($drink->price, 0, ',', '.') }}</div>
                                                    <div class="menu-category">3 menit sajian</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="camilan">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="menu-card">
                                        <div class="menu-image">
                                            <img src="https://www.sasa.co.id/medias/page_medias/lumpia-semarang.png" alt="Lumpia">
                                        </div>
                                        <div class="menu-details">
                                            <div class="menu-title">Lumpia</div>
                                            <div class="menu-price">Rp 25.000</div>
                                            <div class="menu-category">15 menit masak</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dessert">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="menu-card">
                                        <div class="menu-image">
                                            <img src="https://rubenbaamez.com/wp-content/uploads/2024/10/Pudding.jpg" alt="Pudding Karamel">
                                        </div>
                                        <div class="menu-details">
                                            <div class="menu-title">Pudding Karamel</div>
                                            <div class="menu-price">Rp 15.000</div>
                                            <div class="menu-category">5 menit sajian</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Section -->
        <div class="col-md-4 p-4 bg-light">
            <div class="order-section">
                <div class="order-header">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h5 class="mb-0">Pesanan #34562</h5>
                            <small class="text-muted">Selasa 02/12</small>
                        </div>
                        <div>
                            <i class="fas fa-clock me-1"></i>
                            <small>10:03</small>
                        </div>
                    </div>

                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="customerName" class="form-label small">Nama</label>
                            <input type="text" class="form-control form-control-sm" id="customerName" value="Grek">
                        </div>
                        <div class="col-md-6">
                            <label for="tableNumber" class="form-label small">Meja</label>
                            <div class="input-group input-group-sm">
                                <input type="number" class="form-control" id="tableNumber" value="1">
                                <span class="input-group-text">-</span>
                                <input type="number" class="form-control" value="2">
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <div>Menu</div>
                        <div class="d-flex">
                            <div style="width: 50px; text-align: center;">Qty</div>
                            <div style="width: 100px; text-align: right;">Harga</div>
                        </div>
                    </div>
                </div>
                
                <div class="order-items">
                    <div class="order-item">
                        <div class="d-flex">
                            <img src="https://cdn.idntimes.com/content-images/community/2019/08/img-20190811-104247-f4de3b2a582fc434265eef7a3e138268.jpg" alt="Menu" class="item-img me-3">
                            <div class="flex-grow-1">
                                <div class="fw-bold">Nasi Semacem Babi</div>
                                <div class="text-muted small">Rp 40.000</div>
                            </div>
                            <div class="d-flex align-items-center ms-3">
                                <input type="number" class="item-qty" value="2">
                                <div class="text-end ms-3" style="width: 80px;">Rp 80.000</div>
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <input type="text" class="note-input" value="Jangan tambah pedas">
                    
                    <div class="order-item">
                        <div class="d-flex">
                            <img src="https://awsimages.detik.net.id/community/media/visual/2021/12/24/bakmi-babi-bogor-1.jpeg?w=1200" alt="Menu" class="item-img me-3">
                            <div class="flex-grow-1">
                                <div class="fw-bold">Mie Chachu Babi</div>
                                <div class="text-muted small">Rp 40.000</div>
                                <input type="text" class="note-input" placeholder="Order Note...">
                            </div>
                            <div class="d-flex align-items-center ms-3">
                                <input type="number" class="item-qty" value="1">
                                <div class="text-end ms-3" style="width: 80px;">Rp 40.000</div>
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="order-item">
                        <div class="d-flex">
                            <img src="https://awsimages.detik.net.id/community/media/visual/2021/12/24/bakmi-babi-bogor-1.jpeg?w=1200" alt="Menu" class="item-img me-3">
                            <div class="flex-grow-1">
                                <div class="fw-bold">Mie Semacem Babi</div>
                                <div class="text-muted small">Rp 40.000</div>
                                <input type="text" class="note-input" placeholder="Order Note...">
                            </div>
                            <div class="d-flex align-items-center ms-3">
                                <input type="number" class="item-qty" value="3">
                                <div class="text-end ms-3" style="width: 80px;">Rp 120.000</div>
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="order-item">
                        <div class="d-flex">
                            <img src="https://awsimages.detik.net.id/community/media/visual/2021/12/24/bakmi-babi-bogor-1.jpeg?w=1200" alt="Menu" class="item-img me-3">
                            <div class="flex-grow-1">
                                <div class="fw-bold">Mie Chachu Babi</div>
                                <div class="text-muted small">Rp 40.000</div>
                                <input type="text" class="note-input" placeholder="Order Note...">
                            </div>
                            <div class="d-flex align-items-center ms-3">
                                <input type="number" class="item-qty" value="1">
                                <div class="text-end ms-3" style="width: 80px;">Rp 40.000</div>
                            </div>
                        </div>
                        <div class="text-end mt-2">
                            <button class="delete-btn">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="order-summary">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="text-muted">Diskon</div>
                        <div>Rp 0</div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="text-muted">Subtotal</div>
                        <div class="fw-bold">Rp 280.000</div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="taxCheck" checked>
                        <label class="form-check-label" for="taxCheck">
                            Sudah termasuk pajak
                        </label>
                    </div>
                    <a href="payment-system">
                    <button class="checkout-btn">
                        Lanjutkan Pembayaran
                    </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
    
@section('scripts')
    <script>
        // Menambahkan fungsionalitas dasar untuk tab
        document.addEventListener('DOMContentLoaded', function() {
            const menuTabs = document.querySelectorAll('#menuTabs .nav-link');
            menuTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Hapus kelas aktif dari semua tab
                    menuTabs.forEach(item => {
                        item.classList.remove('active');
                    });
                    
                    // Tambahkan kelas aktif ke tab yang diklik
                    this.classList.add('active');
                    
                    // Tampilkan konten tab yang sesuai
                    const tabContentId = this.getAttribute('href');
                    const tabContents = document.querySelectorAll('.tab-pane');
                    tabContents.forEach(content => {
                        content.classList.remove('show', 'active');
                    });
                    document.querySelector(tabContentId).classList.add('show', 'active');
                });
            });
            
            // Fungsionalitas untuk tombol tab Dine In, To Go, Delivery
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
            
            // Fungsionalitas untuk menambahkan item menu ke pesanan
            const menuCards = document.querySelectorAll('.menu-card');
            menuCards.forEach(card => {
                card.addEventListener('click', function() {
                    const menuTitle = this.querySelector('.menu-title').textContent;
                    const menuPrice = this.querySelector('.menu-price').textContent;
                    const menuImage = this.querySelector('.menu-image img').src;
                    
                    // Cek apakah item sudah ada dalam pesanan
                    const orderItems = document.querySelectorAll('.order-item');
                    let itemExists = false;
                    
                    orderItems.forEach(item => {
                        const itemTitle = item.querySelector('.fw-bold').textContent;
                        if (itemTitle === menuTitle) {
                            // Item sudah ada, tambahkan jumlahnya
                            const qtyInput = item.querySelector('.item-qty');
                            let currentQty = parseInt(qtyInput.value);
                            qtyInput.value = currentQty + 1;
                            
                            // Update total harga item
                            const priceText = menuPrice.replace('Rp ', '').replace('.', '');
                            const price = parseInt(priceText);
                            const totalPrice = price * (currentQty + 1);
                            item.querySelector('.text-end.ms-3').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                            
                            itemExists = true;
                        }
                    });
                    
                    if (!itemExists) {
                        // Buat elemen pesanan baru
                        const priceText = menuPrice.replace('Rp ', '').replace('.', '');
                        const price = parseInt(priceText);
                        
                        // Buat template item pesanan baru
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
                                    <button class="delete-btn">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        
                        // Tambahkan item ke list pesanan
                        const orderItemsContainer = document.querySelector('.order-items');
                        orderItemsContainer.insertAdjacentHTML('beforeend', newOrderItem);
                        
                        // Tambahkan event listener untuk tombol hapus
                        const newDeleteBtn = orderItemsContainer.lastElementChild.querySelector('.delete-btn');
                        newDeleteBtn.addEventListener('click', function() {
                            this.closest('.order-item').remove();
                            updateOrderSummary();
                        });
                        
                        // Tambahkan event listener untuk input jumlah
                        const newQtyInput = orderItemsContainer.lastElementChild.querySelector('.item-qty');
                        newQtyInput.addEventListener('change', function() {
                            updateItemTotal(this);
                        });
                    }
                    
                    // Update ringkasan pesanan
                    updateOrderSummary();
                });
            });
            
            // Tambahkan event listener untuk tombol hapus yang sudah ada
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.order-item').remove();
                    updateOrderSummary();
                });
            });
            
            // Tambahkan event listener untuk input jumlah yang sudah ada
            const qtyInputs = document.querySelectorAll('.item-qty');
            qtyInputs.forEach(input => {
                input.addEventListener('change', function() {
                    updateItemTotal(this);
                });
            });
            
            // Fungsi untuk memperbarui total harga per item
            function updateItemTotal(qtyInput) {
                const orderItem = qtyInput.closest('.order-item');
                const priceText = orderItem.querySelector('.text-muted.small').textContent;
                const price = parseInt(priceText.replace('Rp ', '').replace('.', ''));
                const qty = parseInt(qtyInput.value);
                
                if (qty < 1) {
                    qtyInput.value = 1;
                }
                
                const totalPrice = price * parseInt(qtyInput.value);
                orderItem.querySelector('.text-end.ms-3').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                
                updateOrderSummary();
            }
            
            // Fungsi untuk memperbarui ringkasan pesanan
            function updateOrderSummary() {
                let subtotal = 0;
                const orderItems = document.querySelectorAll('.order-item');
                
                orderItems.forEach(item => {
                    const priceText = item.querySelector('.text-end.ms-3').textContent;
                    const price = parseInt(priceText.replace('Rp ', '').replace('.', '').replace(',', ''));
                    subtotal += price;
                });
                
                // Update subtotal di ringkasan pesanan
                document.querySelector('.order-summary .fw-bold').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            }
        });
    </script>
@endsection
