@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Daftar Pesanan')

@section('styles')
<style>
    .order-item {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 15px;
        transition: background-color 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }

    .order-item:hover {
        background-color: #f8f9fa;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .order-left {
        display: flex;
        flex-direction: column;
    }

    .order-id {
        font-weight: bold;
        font-size: 1.1rem;
    }

    .order-time {
        font-size: 0.9rem;
        color: #888;
    }

    .order-price {
        font-weight: bold;
        font-size: 1rem;
        color: #28a745;
        text-align: right;
    }

    .menu-item:last-child {
        border-bottom: none;
    }

    .action-btn, .pay-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        color: white;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
    }

    .action-btn:hover {
        background-color: #218838;
    }

    .pay-btn[disabled] {
        background-color: #6c757d;
        cursor: not-allowed;
    }

    .time-badge {
        background-color: #ffc107;
        color: #212529;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.8rem;
    }

    .date-selector {
        font-size: 0.85rem;
        padding: 4px 10px;
    }
</style>
@endsection

@section('content')
    <!-- Main Content Area -->
    <div class="row mx-0">
        <div class="col-md-8">
            <div class="main-content" style="overflow-y: auto; height: 82vh;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Daftar Pesanan</h4>
                </div>
                
                <!-- Orders Section -->
                @if ($htrans->isEmpty())
                    <div class="alert alert-info">
                        Belum ada transaksi
                    </div>
                @else
                    @foreach ($htrans as $item)
                        <div class="tab-content mb-2" id="pending-tab" onclick="showPesanan({{$item->id}})">
                            <div class="order-item" data-order-id="{{$item->id}}">
                                <div class="order-left">
                                    <div class="order-id">Pesanan #{{$item->id}}</div>
                                    <div class="order-time">Time : {{ date('H:i', strtotime($item->created_at)) }}</div>
                                </div>
                                <div class="order-price">Rp {{ number_format($item->total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                @endif
                
            </div>
        </div>
        
        <!-- Right Panel - Order Details -->
        <div class="col-md-4 p-1">
            <div class="main-content" id="order-details" style="overflow-y: auto; height: 82vh;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <div class="fw-bold" id="order-title">Pesanan -</div>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary date-selector" id="order-date">
                            <i class="far fa-calendar me-1"></i> Select -
                        </button>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="fw-bold">Menu</div>
                        <div class="fw-bold">Qty</div>
                    </div>
                    <div id="menu-list">
                        <!-- Kosong saat awal -->
                    </div>
                </div>
                
                <div class="mb-3">
                    <button class="action-btn" id="print-btn" style="background-color: #28a745;">
                        <i class="fas fa-print me-2"></i> Print Nota
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua elemen order-item dan tambahkan event click
        document.querySelectorAll('.order-item').forEach(item => {
            item.addEventListener('click', function () {
                const orderId = this.getAttribute('data-order-id');
                showPesanan(orderId); // fungsi untuk fetch detail
            });
        });

        // Tombol print (dummy)
        document.getElementById('print-btn').addEventListener('click', function () {
            alert('Printing receipt...');
        });
    });

    function showPesanan(id) {
        fetch('/dtrans')
            .then(res => {
                if (!res.ok) throw new Error('Gagal mengambil data');
                return res.json();
            })
            .then(data => {
                showSaleDetail(id, data);
            })
            .catch(err => console.error(err));
    }

    function showSaleDetail(id, data) {
        const trx = data
            .filter(t => t.htrans_id == id)
            .sort((a, b) => b.subtotal - a.subtotal);

        if (trx.length === 0) return;

        // Update title pesanan
        document.getElementById('order-title').innerText = `Pesanan #${id}`;

        // Tampilkan waktu berdasarkan created_at
        const firstItem = trx[0];
        const time = new Date(firstItem.created_at);
        const formattedDate = time.toLocaleDateString('id-ID');
        document.getElementById('order-date').innerHTML = `<i class="far fa-calendar me-1"></i> ${formattedDate}`;

        // Update menu list
        const menuList = document.getElementById('menu-list');
        menuList.innerHTML = '';

        trx.forEach(item => {
            const div = document.createElement('div');
            div.className = 'menu-item d-flex justify-content-between';
            div.innerHTML = `
                <div>
                    ${item.item_name}
                </div>
                <div>${item.qty}</div>
            `;
            menuList.appendChild(div);
        });
    }

</script>
@endsection