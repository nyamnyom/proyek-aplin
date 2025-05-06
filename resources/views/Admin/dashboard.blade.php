<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  @include('style.adminStyle')
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
      <div class="p-2 pt-3">
        <h6 class="text-uppercase text-muted mb-3 ms-2 small">Main Menu</h6>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="manajemen-menu.php"><i class="bi bi-egg-fried"></i> Manajemen Menu</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="riwayat-penjualan.php"><i class="fas fa-list-alt"></i> Riwayat Penjualan</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="manajemen-pegawai.php"><i class="bi bi-people-fill"></i> Manajemen Pegawai</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="daftar-event.php"><i class="fas fa-calendar"></i> Daftar Event</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="inventaris.php"><i class="bi bi-cart-fill"></i> Inventaris</a></li>
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
                            <li><a class="dropdown-item logout" href="../login.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Konten halaman di sini -->
        <!-- Sidebar dan Navbar sudah diasumsikan terpasang -->
<div class="container-fluid">
  <h3 class="fw-bold">Welcome, Alexander!</h3>

  <div class="row g-4">
    <!-- Total Cards -->
    <div class="col-md-4">
      <div class="card shadow-sm p-3">
        <h6 class="text-muted">Total Net Profit</h6>
        <h4 class="text-danger">Rp 5.400.000</h4>
        <p class="text-success small"><i class="fas fa-arrow-up"></i> 23% lebih banyak dari bulan lalu</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm p-3">
        <h6 class="text-muted">Total Order</h6>
        <h4 class="text-danger">273</h4>
        <p class="text-danger small"><i class="fas fa-arrow-down"></i> 14% lebih sedikit dari bulan lalu</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm p-3">
        <h6 class="text-muted">Pengeluaran</h6>
        <h4 class="text-danger">Rp 2.500.000</h4>
        <p class="text-success small"><i class="fas fa-arrow-down"></i> -3% lebih rendah dari bulan lalu</p>
      </div>
    </div>
  </div>

  <div class="row g-4 mt-2">
    <!-- Donut Chart Dummy -->
    <div class="col-md-6">
      <div class="card shadow-sm p-3">
        <div class="d-flex justify-content-between">
          <h6>Bagan Waktu</h6>
          <span class="badge bg-light text-dark">15 Nov</span>
        </div>
        <canvas id="donutChart"></canvas>
        <p class="text-muted small">Garis waktu pelanggan mengunjungi toko</p>
      </div>
    </div>

    <!-- Status Karyawan -->
    <div class="col-md-6">
      <div class="card shadow-sm p-3">
        <h6>Status Karyawan</h6>
        <table class="table table-sm">
          <thead class="table-light">
            <tr><th>Nama</th><th>Jabatan</th><th>Status</th></tr>
          </thead>
          <tbody>
            <tr><td>Rama Harman</td><td>General Manager</td><td><span class="badge bg-success">Tersedia</span></td></tr>
            <tr><td>Bhaskara</td><td>Assistant Manager</td><td><span class="badge bg-success">Tersedia</span></td></tr>
            <tr><td>Prakash Kumar</td><td>Supervisor</td><td><span class="badge bg-success">Tersedia</span></td></tr>
            <tr><td>Hariawan</td><td>Koki Eksekutif</td><td><span class="badge bg-success">Tersedia</span></td></tr>
            <tr><td>Rama Harman</td><td>Waiter</td><td><span class="badge bg-success">Tersedia</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row g-4 mt-2">
    <!-- Chart Dummy -->
    <div class="col-md-8">
      <div class="card shadow-sm p-3">
        <h6>Perbandingan Penjualan Bulan Lalu dan Bulan Ini</h6>
        <canvas id="lineChart"></canvas>
      </div>
    </div>

    <!-- Popularitas Menu -->
    <div class="col-md-4">
      <div class="card shadow-sm p-3">
        <h6 class="text-danger">Popularitas</h6>
        <table class="table table-sm">
          <thead><tr><th>Nama Item</th><th>%Sold</th></tr></thead>
          <tbody>
            <tr><td>Mie Babi Cincang, Ayam & Charsiu</td><td>32%</td></tr>
            <tr><td>Mix Daging & Sancam</td><td>25%</td></tr>
            <tr><td>Es Teh Manis</td><td>18%</td></tr>
            <tr><td>Bakwan Campur Komplit</td><td>14%</td></tr>
            <tr><td>Lain - Lain</td><td>11%</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row g-4 mt-2">
    <!-- Status Order -->
    <div class="col-md-6">
      <div class="card shadow-sm p-3">
        <h6>Status Order</h6>
        <table class="table table-sm">
          <thead class="table-light"><tr><th>Order ID</th><th>Order</th><th>Status</th></tr></thead>
          <tbody>
            <tr><td>#00014978</td><td>1x Mie Babi Cincang, Ayam & Charsiu</td><td><span class="badge bg-secondary">Pending</span></td></tr>
            <tr><td>#00014979</td><td>1x Sancam 500gr, 2x Es Teh Manis</td><td><span class="badge bg-secondary">Pending</span></td></tr>
            <tr><td>#00014980</td><td>2x Bakwan Babi Halus, 1x Mie Ayam Putih</td><td><span class="badge bg-secondary">Pending</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Status Inventaris -->
    <div class="col-md-6">
      <div class="card shadow-sm p-3">
        <h6>Status Inventaris</h6>
        <table class="table table-sm">
          <thead class="table-light"><tr><th>Nama Item</th><th>Sisa</th><th>Kadaluarsa</th><th>Status</th><th>Reorder</th></tr></thead>
          <tbody>
            <tr><td>Daging Babi</td><td>50 Kg</td><td>12 Des 2024</td><td>95%</td><td><span class="text-danger">✔</span></td></tr>
            <tr><td>Paha Babi</td><td>5 Kg</td><td>05 Des 2024</td><td>75%</td><td><span class="text-danger">✔</span></td></tr>
            <tr><td>Dada Babi</td><td>50 Kg</td><td>15 Des 2024</td><td>90%</td><td><span class="text-danger">✔</span></td></tr>
            <tr><td>Jeroan Babi</td><td>50 Kg</td><td>25 Des 2024</td><td>60%</td><td></td></tr>
            <tr><td>Lemak Babi</td><td>20 Kg</td><td>28 Des 2024</td><td>50%</td><td></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Chart JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctxDonut = document.getElementById('donutChart');
  new Chart(ctxDonut, {
    type: 'doughnut',
    data: {
      labels: ['11.00 - 14.30', '14.30 - 17.30', '17.30 - 21.00'],
      datasets: [{
        data: [44, 18, 38],
        backgroundColor: ['#f4c430', '#ff595e', '#198754']
      }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
  });

  const ctxLine = document.getElementById('lineChart');
  new Chart(ctxLine, {
    type: 'line',
    data: {
      labels: ['24', '25', '26', '27', '28', '29', '30'],
      datasets: [
        {
          label: 'Penjualan Bulan Ini',
          data: [5.1, 4.9, 5.0, 5.3, 6.0, 5.8, 5.5],
          borderColor: 'green',
          tension: 0.3
        },
        {
          label: 'Penjualan Bulan Lalu',
          data: [4.6, 4.7, 4.8, 4.9, 4.8, 4.9, 4.6],
          borderColor: 'orange',
          tension: 0.3
        }
      ]
    },
    options: {
      scales: {
        y: { beginAtZero: false },
        x: { title: { display: true, text: 'Tanggal' } }
      }
    }
  });
</script>


      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>