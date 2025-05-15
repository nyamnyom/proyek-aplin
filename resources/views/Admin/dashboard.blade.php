@extends('Layout.layout-admin')

@section('title', 'Dashboard Admin')

@section('content')
  
  <!-- Konten halaman di sini -->
  <!-- Sidebar dan Navbar sudah diasumsikan terpasang -->

    <h3 class="fw-bold">Welcome, Admin!</h3>

    <div class="row g-4">
    <!-- Total Cards -->
      <div class="col-md-6">
        <div class="card shadow-sm p-3">
          <h6 class="text-muted">Total Omzet</h6>
          <h4 class="text-danger">Rp <span id="total_profit"></span></h4>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm p-3">
          <h6 class="text-muted">Total Order</h6>
          <h4 class="text-danger" id="total_order"></h4>
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
            <tbody id="employeeList">
              {{-- pegawai --}}            
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
            <thead><tr><th>Nama Item</th><th>Sold</th></tr></thead>
            <tbody id="popularitas_menu">
              {{-- qty per menu --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function sumQtyByItemNameSorted(data) {
      const result = {};
    
      data.forEach(item => {
        if (!result[item.item_name]) {
          result[item.item_name] = 0;
        }
        result[item.item_name] += Number(item.qty);
      });
    
      // Ubah hasil ke array lalu urutkan descending berdasarkan qty
      const sortedArray = Object.entries(result)
        .sort((a, b) => b[1] - a[1]) // sort by qty descending
        .map(([item_name, qty]) => ({ item_name, qty }));
      
      return sortedArray; // array of { item_name, qty }
    }

    function loadDtrans() {
      fetch('/dtrans')
        .then(res => {
          if (!res.ok) throw new Error('Fetch error');
          return res.json();
        })
        .then(data => {
          let totalQty = 0;
          let totalSubtotal = 0;
          const list = document.getElementById('popularitas_menu');
        
          data.forEach(item => {
            totalQty += Number(item.qty); // hitung total qty
            totalSubtotal += Number(item.subtotal); // hitung total qty
          });

          const totalPerItem = sumQtyByItemNameSorted(data);
          console.log('Total qty per item:', totalPerItem);

          totalPerItem.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${item.item_name}</td>
              <td>${item.qty}</td>
            `;
            list.appendChild(row);
          });
        
          // Tampilkan total qty ke elemen dengan id totalQtyDisplay (buat di HTML)
          const totalQtyDisplay = document.getElementById('total_order');
          if (totalQtyDisplay) {
            totalQtyDisplay.innerHTML = totalQty;
          }
          const totalProfit = document.getElementById('total_profit');
          if (totalProfit) {
            totalProfit.innerHTML = totalSubtotal;
          }
        })
        .catch(err => console.error(err));
    }
    window.onload = loadDtrans;


    function getData() {
      fetch('/user')
        .then(response => {
          if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
          return response.json();
        })
        .then(usersArray => {
          const list = document.getElementById('employeeList');
          if (!list) {
            console.error('Elemen dengan id "employeeList" tidak ditemukan');
            return;
          }
        
          list.innerHTML = ''; // kosongkan dulu isi tabel
        
          usersArray.forEach(emp => {
            const row = document.createElement('tr');
          
            const statusBadge = emp.is_active == 1
              ? '<span class="badge bg-success">Aktif</span>'
              : '<span class="badge bg-secondary">Non Aktif</span>';
          
            row.innerHTML = `
              <td>${emp.nama}</td>
              <td>${emp.posisi}</td>
              <td>${statusBadge}</td>
            `;
          
            list.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Fetch error:', error);
        });
    }

    // Jalankan saat halaman dimuat
    getData();

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

