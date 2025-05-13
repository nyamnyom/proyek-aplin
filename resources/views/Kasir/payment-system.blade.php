@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Sistem Kasir (Pembayaran)')

@section('content')
<div class="row mx-0" style="height: 100vh; overflow-y: auto;">
                    <!-- Pesanan Section -->
                    <div class="col-md-6">
                        <div class="main-content" style="height: 100vh; overflow-y: auto;">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">Tambah Pesanan</h4>
                                <div class="text-muted">
                                    <small>Main Menu / Tambah Pesanan</small>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="fw-bold mb-2">Pesanan #34562</div>
                                        <div class="text-muted small">Selasa 02/12</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end">
                                            <i class="fas fa-clock me-1"></i>
                                            <div class="text-muted small">10:03</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="customerName" class="form-label small">Nama</label>
                                        <input type="text" class="form-control" id="customerName" value="Grek">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tableNumber" class="form-label small">Meja</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="tableNumber" value="1">
                                            <span class="input-group-text">-</span>
                                            <input type="number" class="form-control" value="2">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <div>Menu</div>
                                    <div class="d-flex">
                                        <div style="width: 40px; text-align: center;">Qty</div>
                                        <div style="width: 80px; text-align: right;">Harga</div>
                                    </div>
                                </div>
                                
                                <div class="order-items">
                                    <div class="order-item d-flex align-items-center">
                                        <img src="https://nibble-images.b-cdn.net/nibble/original_images/nasi-campur-babi-di-jakarta-01.jpg" alt="Menu" class="item-img me-3">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Nasi Semacem Babi</div>
                                            <div class="text-muted small">Rp 40.000</div>
                                        </div>
                                        <div class="ms-3 me-3 text-center">
                                            <input type="number" class="item-qty" value="2">
                                        </div>
                                        <div class="me-2" style="width: 80px; text-align: right;">
                                            <span>Rp 80.000</span>
                                        </div>
                                        <button class="delete-btn">
                                            <i class="fas fa-times small"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="order-item d-flex align-items-center">
                                        <img src="https://nibble-images.b-cdn.net/nibble/original_images/nasi-campur-babi-di-jakarta-01.jpg" alt="Menu" class="item-img me-3">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Nasi Chachu Babi</div>
                                            <div class="text-muted small">Rp 40.000</div>
                                        </div>
                                        <div class="ms-3 me-3 text-center">
                                            <input type="number" class="item-qty" value="1">
                                        </div>
                                        <div class="me-2" style="width: 80px; text-align: right;">
                                            <span>Rp 40.000</span>
                                        </div>
                                        <button class="delete-btn">
                                            <i class="fas fa-times small"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="order-item d-flex align-items-center">
                                        <img src="https://nibble-images.b-cdn.net/nibble/original_images/nasi-campur-babi-di-jakarta-01.jpg" alt="Menu" class="item-img me-3">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Mie Semacem Babi</div>
                                            <div class="text-muted small">Rp 40.000</div>
                                        </div>
                                        <div class="ms-3 me-3 text-center">
                                            <input type="number" class="item-qty" value="3">
                                        </div>
                                        <div class="me-2" style="width: 80px; text-align: right;">
                                            <span>Rp 120.000</span>
                                        </div>
                                        <button class="delete-btn">
                                            <i class="fas fa-times small"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal</span>
                                        <span class="fw-bold">Rp 240.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Diskon</span>
                                        <span>Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pembayaran Section -->
                    <div class="col-md-6 mb-5">
                        <div class="main-content">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">Pembayaran</h4>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="paymentCustomerName" class="form-label small">Nama</label>
                                    <input type="text" class="form-control" id="paymentCustomerName" value="Grek">
                                </div>
                                <div class="col-md-6">
                                    <label for="paymentTableNumber" class="form-label small">Meja</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="paymentTableNumber" value="1">
                                        <span class="input-group-text">-</span>
                                        <input type="number" class="form-control" value="2">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <div>Menu</div>
                                <div class="d-flex">
                                    <div style="width: 40px; text-align: center;">Qty</div>
                                    <div style="width: 80px; text-align: right;">Harga</div>
                                </div>
                            </div>
                            
                            <div class="payment-details mt-4">
                                <h6 class="mb-3">Rincian Pembayaran</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small">Catatan Order</label>
                                    <input type="text" class="form-control" placeholder="...">
                                </div>
                                
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
                                        <div class="payment-method">
                                            <div class="text-center">
                                                <i class="fas fa-credit-card fa-2x"></i>
                                            </div>
                                            <div class="small mt-1">OVO</div>
                                        </div>
                                        <div class="payment-method">
                                            <div class="text-center">
                                                <i class="fas fa-wallet fa-2x"></i>
                                            </div>
                                            <div class="small mt-1">e-Wallet</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="paymentAmount" class="form-label small">Jumlah Pembayaran (Cash)</label>
                                    <input type="text" class="form-control" id="paymentAmount" value="250.000">
                                </div>
                            </div>
                            
                            <div class="payment-summary">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>Rp 240.000</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Diskon</span>
                                    <span>Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Pajak</span>
                                    <span>Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold">Rp 240.000</span>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Diterima</span>
                                    <span>Rp 250.000</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Kembali</span>
                                    <span>Rp 10.000</span>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <button class="cancel-btn me-2">Cancel</button>
                                <button class="confirm-btn">Selesaikan Pembayaran</button>
                            </div>
                        </div>
                    </div>
                </div>
                
@endsection
{{-- 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wei Hong Restaurant - Sistem Kasir (Pembayaran)</title>
    @include('style.kasirStyle')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="p-3 d-flex align-items-center">
                    <div class="logo">WH</div>
                    <span class="navbar-brand">Wei Hong</span>
                </div>
                <div class="p-3">
                    <h6 class="text-uppercase text-muted mb-3 small">Main Menu</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item" >
                            <a class="nav-link active" href="kasir-main">
                                <i class="fas fa-plus-circle me-2"></i> Tambah Pesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reservasi-meja">
                                <i class="fas fa-bookmark me-2"></i> Reservasi Meja
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="daftar-pesanan">
                                <i class="fas fa-clipboard-list me-2"></i> Daftar Pesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user-plus me-2"></i> Tambah Member
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-percentage me-2"></i> Promosi dan Diskon
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i> Pengaturan Sistem
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 px-0">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand navbar-light bg-white p-3">
                    <div class="container-fluid">
                        <form class="d-flex flex-grow-1 mx-4">
                            <input class="form-control search-bar" type="search" placeholder="Cari menu, pelanggan, dll..." aria-label="Search">
                        </form>
                        <div class="d-flex align-items-center">
                            <div class="notification-icon mx-3">
                                <i class="fas fa-bell fa-lg text-muted"></i>
                                <span class="notification-badge">3</span>
                            </div>
                            <div class="notification-icon mx-3">
                                <i class="fas fa-comment fa-lg text-muted"></i>
                                <span class="notification-badge">2</span>
                            </div>
                            <div class="notification-icon mx-3">
                                <i class="fas fa-heart fa-lg text-muted"></i>
                                <span class="notification-badge">1</span>
                            </div>
                            <div class="user-profile ms-4 dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <img src="https://img.freepik.com/premium-photo/fun-unique-cartoon-profile-picture-that-represents-your-style-personality_1283595-14223.jpg" alt="Profile" class="profile-img">
                                    <div class="ms-2">
                                        <div class="small fw-bold">Alexander Brick</div>
                                        <div class="text-muted small">Kasir</div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item logout" href="/">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <div class="row mx-0">
                    <!-- Pesanan Section -->
                    <div class="col-md-6">
                        <div class="main-content">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">Tambah Pesanan</h4>
                                <div class="text-muted">
                                    <small>Main Menu / Tambah Pesanan</small>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="fw-bold mb-2">Pesanan #34562</div>
                                        <div class="text-muted small">Selasa 02/12</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end">
                                            <i class="fas fa-clock me-1"></i>
                                            <div class="text-muted small">10:03</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="customerName" class="form-label small">Nama</label>
                                        <input type="text" class="form-control" id="customerName" value="Grek">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tableNumber" class="form-label small">Meja</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="tableNumber" value="1">
                                            <span class="input-group-text">-</span>
                                            <input type="number" class="form-control" value="2">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <div>Menu</div>
                                    <div class="d-flex">
                                        <div style="width: 40px; text-align: center;">Qty</div>
                                        <div style="width: 80px; text-align: right;">Harga</div>
                                    </div>
                                </div>
                                
                                <div class="order-items">
                                    <div class="order-item d-flex align-items-center">
                                        <img src="https://nibble-images.b-cdn.net/nibble/original_images/nasi-campur-babi-di-jakarta-01.jpg" alt="Menu" class="item-img me-3">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Nasi Semacem Babi</div>
                                            <div class="text-muted small">Rp 40.000</div>
                                        </div>
                                        <div class="ms-3 me-3 text-center">
                                            <input type="number" class="item-qty" value="2">
                                        </div>
                                        <div class="me-2" style="width: 80px; text-align: right;">
                                            <span>Rp 80.000</span>
                                        </div>
                                        <button class="delete-btn">
                                            <i class="fas fa-times small"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="order-item d-flex align-items-center">
                                        <img src="https://nibble-images.b-cdn.net/nibble/original_images/nasi-campur-babi-di-jakarta-01.jpg" alt="Menu" class="item-img me-3">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Nasi Chachu Babi</div>
                                            <div class="text-muted small">Rp 40.000</div>
                                        </div>
                                        <div class="ms-3 me-3 text-center">
                                            <input type="number" class="item-qty" value="1">
                                        </div>
                                        <div class="me-2" style="width: 80px; text-align: right;">
                                            <span>Rp 40.000</span>
                                        </div>
                                        <button class="delete-btn">
                                            <i class="fas fa-times small"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="order-item d-flex align-items-center">
                                        <img src="https://nibble-images.b-cdn.net/nibble/original_images/nasi-campur-babi-di-jakarta-01.jpg" alt="Menu" class="item-img me-3">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Mie Semacem Babi</div>
                                            <div class="text-muted small">Rp 40.000</div>
                                        </div>
                                        <div class="ms-3 me-3 text-center">
                                            <input type="number" class="item-qty" value="3">
                                        </div>
                                        <div class="me-2" style="width: 80px; text-align: right;">
                                            <span>Rp 120.000</span>
                                        </div>
                                        <button class="delete-btn">
                                            <i class="fas fa-times small"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal</span>
                                        <span class="fw-bold">Rp 240.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Diskon</span>
                                        <span>Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pembayaran Section -->
                    <div class="col-md-6">
                        <div class="main-content">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0">Pembayaran</h4>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="paymentCustomerName" class="form-label small">Nama</label>
                                    <input type="text" class="form-control" id="paymentCustomerName" value="Grek">
                                </div>
                                <div class="col-md-6">
                                    <label for="paymentTableNumber" class="form-label small">Meja</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="paymentTableNumber" value="1">
                                        <span class="input-group-text">-</span>
                                        <input type="number" class="form-control" value="2">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between text-muted small mb-2">
                                <div>Menu</div>
                                <div class="d-flex">
                                    <div style="width: 40px; text-align: center;">Qty</div>
                                    <div style="width: 80px; text-align: right;">Harga</div>
                                </div>
                            </div>
                            
                            <div class="payment-details mt-4">
                                <h6 class="mb-3">Rincian Pembayaran</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small">Catatan Order</label>
                                    <input type="text" class="form-control" placeholder="...">
                                </div>
                                
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
                                        <div class="payment-method">
                                            <div class="text-center">
                                                <i class="fas fa-credit-card fa-2x"></i>
                                            </div>
                                            <div class="small mt-1">OVO</div>
                                        </div>
                                        <div class="payment-method">
                                            <div class="text-center">
                                                <i class="fas fa-wallet fa-2x"></i>
                                            </div>
                                            <div class="small mt-1">e-Wallet</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="paymentAmount" class="form-label small">Jumlah Pembayaran (Cash)</label>
                                    <input type="text" class="form-control" id="paymentAmount" value="250.000">
                                </div>
                            </div>
                            
                            <div class="payment-summary">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>Rp 240.000</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Diskon</span>
                                    <span>Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Pajak</span>
                                    <span>Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold">Rp 240.000</span>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Diterima</span>
                                    <span>Rp 250.000</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Kembali</span>
                                    <span>Rp 10.000</span>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <button class="cancel-btn me-2">Cancel</button>
                                <button class="confirm-btn">Selesaikan Pembayaran</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Bootstrap JS and Popper.js -->
{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
            
            // Hitung kembalian
            const total = 240000; // Total pembayaran dalam contoh
            const payment = parseInt(value.replace(/\./g, '')) || 0;
            const change = payment - total;
            
            if (change >= 0) {
                document.querySelector('.d-flex.justify-content-between:nth-last-child(3)').innerHTML = 
                    `<span>Diterima</span><span>Rp ${payment.toLocaleString('id-ID')}</span>`;
                document.querySelector('.d-flex.justify-content-between:nth-last-child(2)').innerHTML = 
                    `<span>Kembali</span><span>Rp ${change.toLocaleString('id-ID')}</span>`;
            } else {
                document.querySelector('.d-flex.justify-content-between:nth-last-child(3)').innerHTML = 
                    `<span>Diterima</span><span>Rp ${payment.toLocaleString('id-ID')}</span>`;
                document.querySelector('.d-flex.justify-content-between:nth-last-child(2)').innerHTML = 
                    `<span>Kembali</span><span>Rp 0</span>`;
            }
        });
        
        // Fungsionalitas untuk tombol hapus item
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderItem = this.closest('.order-item');
                orderItem.remove();
                updateSubtotal();
            });
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
            const discount = parseInt(document.querySelector('.d-flex.justify-content-between:nth-child(2) span:last-child').textContent.replace(/\D/g, '')) || 0;
            const tax = parseInt(document.querySelector('.payment-summary .d-flex.justify-content-between:nth-child(3) span:last-child').textContent.replace(/\D/g, '')) || 0;
            const grandTotal = subtotal - discount + tax;
            
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
            
            // Proses pembayaran
            alert('Pembayaran berhasil diselesaikan!');
            
            // Reset form atau redirect ke halaman baru
            setTimeout(() => {
                window.location.reload();
            }, 1000);
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
