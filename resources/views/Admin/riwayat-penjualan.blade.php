<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penjualan</title>
    @include('style.adminStyle')
</head>
<body>
    <div class="container-fluid">
    <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 px-0 sidebar">
      <div class="p-3 d-flex align-items-center">
        <div class="logo">WH</div>
        <span class="navbar-brand mb-0">Wei Hong</span>
      </div>
      <div class="p-2 pt-3">
        <h6 class="text-uppercase text-muted mb-3 ms-2 small">Main Menu</h6>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="nav-link" href="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="manajemen-menu"><i class="bi bi-egg-fried"></i> Manajemen Menu</a></li>
            <li class="nav-item mb-2"><a class="nav-link active" href="riwayat-penjualan"><i class="fas fa-list-alt"></i> Riwayat Penjualan</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="manajemen-pegawai"><i class="bi bi-people-fill"></i> Manajemen Pegawai</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="daftar-event"><i class="fas fa-calendar"></i> Daftar Event</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="inventaris"><i class="bi bi-cart-fill"></i> Inventaris</a></li>
        </ul>
      </div>
    </div>

    <!-- Konten Utama -->
    <div class="col-md-10 offset-md-2 p-4">
      <!-- Navbar Atas -->
        <nav class="navbar navbar-expand navbar-light bg-white p-3 mb-4">
            <div class="container-fluid">
            <form class="d-flex flex-grow-1 mx-4">
                <input class="form-control search-bar" type="search" placeholder="Cari pelanggan..." aria-label="Search">
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
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKAamFgOgNtmpuPBVncHVC-AJALeVJB0LyvQ&s" alt="Profile" class="profile-img">
                            <div>
                            <div class="small fw-bold">Alexander Brick</div>
                            <div class="text-muted small">Admin</div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item logout" href="/">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
                
                <!-- Main Content Area -->
                <div class="container-fluid py-4">
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
</div>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
