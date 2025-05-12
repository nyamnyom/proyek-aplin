@extends('Layout.layout-admin')

@section('title', 'Daftar Event')

@section('content')
  <h4 class="fw-bold">Riwayat Penjualan</h4>
  <div class="row mt-4">
    <!-- List Penjualan -->
    <div class="col-md-7">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search by ID" oninput="filterSales()" id="searchInput" />
        <button class="btn btn-outline-secondary" type="button" onclick="filterSales()">
          <i class="fas fa-search"></i>
        </button>
      </div>

      <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
          <a class="nav-link active" href="#" onclick="filterByRange('today')">Hari Ini</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="filterByRange('week')">Minggu Ini</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="filterByRange('month')">Bulan Ini</a>
        </li>
      </ul>

      <div class="list-group" id="salesList">
        <!-- List akan diisi oleh JavaScript -->
      </div>
    </div>

    <!-- Detail Penjualan -->
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="fw-bold" id="trxDetail">Pilih transaksi</h6>
            <input type="date" class="form-control form-control-sm w-auto" id="trxDate" disabled />
          </div>

          <table class="table mt-3">
            <thead>
              <tr>
                <th>Menu</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody id="detailTable">
              <tr><td colspan="2" class="text-muted">Belum ada transaksi dipilih</td></tr>
            </tbody>
          </table>

          <button class="btn btn-success w-100" id="printButton" disabled>
            <i class="fas fa-print"></i> Print Nota
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
  const transactions = [
    { id: 'TRX12345', cashier: 'Rina', date: '2024-12-02', time: '12:10', total: 325000, items: [['Nasi Samcan Babi', 2], ['Mie Chasiu Babi', 1], ['Nasi Chasiu Babi', 1]] },
    { id: 'TRX12346', cashier: 'Budi', date: '2024-12-02', time: '12:25', total: 210000, items: [['Mie Samcan Babi', 2], ['Nasi Samcan Babi', 1]] },
    { id: 'TRX12347', cashier: 'Rina', date: '2024-12-01', time: '11:00', total: 150000, items: [['Mie Chasiu Babi', 3]] },
    { id: 'TRX12348', cashier: 'Sinta', date: '2024-11-29', time: '13:45', total: 370000, items: [['Nasi Samcan Babi', 2], ['Nasi Chasiu Babi', 2]] },
    { id: 'TRX12349', cashier: 'Budi', date: '2024-11-25', time: '10:15', total: 120000, items: [['Mie Samcan Babi', 1], ['Mie Chasiu Babi', 1]] },
    { id: 'TRX12350', cashier: 'Rina', date: '2024-11-03', time: '09:45', total: 265000, items: [['Nasi Samcan Babi', 3], ['Mie Chasiu Babi', 2]] }
  ];
  
  function renderSales(data) {
    const list = document.getElementById('salesList');
    list.innerHTML = '';
    data.forEach(t => {
      list.innerHTML += `
        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSaleDetail('${t.id}')">
          <div>
            <strong>${t.id}</strong><br />
            <small>Nama Kasir: ${t.cashier}</small>
          </div>
          <div class="text-end">
            <span class="badge bg-danger">${t.time}</span><br />
            <strong>Rp ${t.total.toLocaleString('id-ID')}</strong>
          </div>
        </a>`;
    });
  }
  
  function showSaleDetail(id) {
    const trx = transactions.find(t => t.id === id);
    if (!trx) return;
  
    document.getElementById('trxDetail').innerText = `${trx.id} | ${trx.cashier}`;
    document.getElementById('trxDate').value = trx.date;
    document.getElementById('trxDate').disabled = false;
    document.getElementById('printButton').disabled = false;
  
    const tbody = document.getElementById('detailTable');
    tbody.innerHTML = '';
    trx.items.forEach(item => {
      tbody.innerHTML += `<tr><td>${item[0]}</td><td>${item[1]}</td></tr>`;
    });
  }
  
  function filterSales() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const filtered = transactions.filter(t => t.id.toLowerCase().includes(query));
    renderSales(filtered);
  }
  
  function filterByRange(range) {
    const today = new Date();
    const filtered = transactions.filter(t => {
      const trxDate = new Date(t.date);
      if (range === 'today') {
        return trxDate.toDateString() === today.toDateString();
      } else if (range === 'week') {
        const weekAgo = new Date(today);
        weekAgo.setDate(today.getDate() - 7);
        return trxDate >= weekAgo && trxDate <= today;
      } else if (range === 'month') {
        return trxDate.getMonth() === today.getMonth() && trxDate.getFullYear() === today.getFullYear();
      }
      return true;
    });
    renderSales(filtered);
  }
  
  // Render all sales on load
  renderSales(transactions);
  </script>
@endsection
