@extends('Layout.layout-admin')

@section('title', 'Dashboard Admin')

@section('content')
  
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
@endsection

@section('scripts')
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
@endsection

