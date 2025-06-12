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
            <h6>Ringkasan Penjualan Berdasarkan Kategori</h6>
            <span id="donutDate" class="badge bg-light text-dark fw-bold"></span>
          </div>
        <canvas id="donutChart"></canvas>
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
          <div class="mt-3 d-flex justify-content-center" id="paginationControls"></div>
        </div>
      </div>
    </div>

    <div class="row g-4 mt-2">
      <!-- Chart Dummy -->
      <div class="col-md-8">
        <div class="card shadow-sm p-3">
          <h5 id="chartTitle" class="card-title">Rekap Penjualan Harian Bulan Ini</h6>
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
        window.employees = usersArray || []; // Simpan di global
        loadEmployees(1); // Panggil render halaman pertama
      })
      .catch(error => {
        console.error('Fetch error:', error);
      });
  }

    let currentPage = 1;
    const itemsPerPage = 5;

    function loadEmployees(page = 1) {
      const list = document.getElementById('employeeList');
      const pagination = document.getElementById('paginationControls');

      if (!list || !window.employees) return;

      currentPage = page;
      list.innerHTML = '';

      const start = (page - 1) * itemsPerPage;
      const end = start + itemsPerPage;
      const employeesToShow = window.employees.slice(start, end);

      employeesToShow.forEach(emp => {
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

      // Tambahkan baris kosong jika kurang dari 5
      const emptyRows = itemsPerPage - employeesToShow.length;
      for (let i = 0; i < emptyRows; i++) {
        const emptyRow = document.createElement('tr');
        emptyRow.innerHTML = `
          <td>&nbsp;</td>
          <td></td>
          <td></td>
        `;
        list.appendChild(emptyRow);
      }

      renderPagination(window.employees.length);
    }

  function renderPagination(totalItems) {
    const pagination = document.getElementById('paginationControls');
    if (!pagination) return;

    const totalPages = Math.ceil(totalItems / itemsPerPage);
    pagination.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
      const btn = document.createElement('button');
      btn.className = `btn btn-sm me-1 ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'}`;
      btn.innerText = i;
      btn.onclick = () => loadEmployees(i);
      pagination.appendChild(btn);
    }
  }

  getData()


    // function getData() {
    //   fetch('/user')
    //     .then(response => {
    //       if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    //       return response.json();
    //     })
    //     .then(usersArray => {
    //       const list = document.getElementById('employeeList');
    //       if (!list) {
    //         console.error('Elemen dengan id "employeeList" tidak ditemukan');
    //         return;
    //       }
        
    //       list.innerHTML = ''; // kosongkan dulu isi tabel
        
    //       usersArray.forEach(emp => {
    //         const row = document.createElement('tr');
          
    //         const statusBadge = emp.is_active == 1
    //           ? '<span class="badge bg-success">Aktif</span>'
    //           : '<span class="badge bg-secondary">Non Aktif</span>';
          
    //         row.innerHTML = `
    //           <td>${emp.nama}</td>
    //           <td>${emp.posisi}</td>
    //           <td>${statusBadge}</td>
    //         `;
          
    //         list.appendChild(row);
    //       });
    //     })
    //     .catch(error => {
    //       console.error('Fetch error:', error);
    //     });
    // }

    // getData();

    function getQtyPerCategory(menus, dtrans) {
      const categoryTotals = {};

      dtrans.forEach(d => {
        // Temukan menu yang sesuai dengan item_name
        const menu = menus.find(m => m.name === d.item_name);
        if (menu) {
          const category = menu.category;
          if (!categoryTotals[category]) {
            categoryTotals[category] = 0;
          }
          categoryTotals[category] += d.qty;
        }
      });
      console.log(categoryTotals)
      return categoryTotals;
    }

    function dateDonut(){
      const donutDate = document.getElementById('donutDate');
      const today = new Date();
      const options = { day: '2-digit', month: 'short' }; 
      donutDate.textContent = today.toLocaleDateString('id-ID', options);
    }

    function dateChart() {
      const now = new Date();
      const monthYear = now.toLocaleString('id-ID', { month: 'long', year: 'numeric' });
      document.getElementById('chartTitle').textContent = `Rekap Penjualan Harian Bulan ${monthYear}`;
    }

    function donat() {
      fetch('/menu')
        .then(res => {
          if (!res.ok) throw new Error('Gagal fetch menus');
          return res.json();
        })
        .then(menus => {
          return fetch('/dtrans')
            .then(res => {
              if (!res.ok) throw new Error('Gagal fetch dtrans');
              return res.json();
            })
            .then(dtrans => {
              const result = getQtyPerCategory(menus, dtrans);
              console.log(result);
              generateDonat(result);
              dateDonut();
              dateChart()
            });
        })
        .catch(err => console.error('Error:', err));
    }

    donat();

    function generateDonat(data){
      const ctxDonut = document.getElementById('donutChart');
      const labels = Object.keys(data);
      const datas = Object.values(data);
      new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
          labels: labels,
          datasets: [{
            data: datas,
            backgroundColor: ['#f4c430', '#ff595e']
          }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
      });
    }

    function groupTotalPerDate(data) {
      const totals = {};

      data.forEach(item => {
        const date = item.created_at.slice(0, 10); // 'YYYY-MM-DD'
        totals[date] = (totals[date] || 0) + item.total;
      });
    
      return totals;
    }

    function line() {
      fetch('/htrans')
        .then(res => res.json())
        .then(htrans => {
          const today = new Date();
          const currentYear = today.getFullYear();
          const currentMonth = String(today.getMonth() + 1).padStart(2, '0'); // bulan dari 0-11
        
          // Filter hanya data bulan ini
          const filtered = htrans.filter(item => {
            const [year, month] = item.created_at.slice(0, 7).split('-');
            return year == currentYear && month == currentMonth;
          });
        
          const totalsByDate = groupTotalPerDate(filtered);
          const labels = Object.keys(totalsByDate).sort();
          const dataTotals = labels.map(date => totalsByDate[date]);
        
          const ctxLine = document.getElementById('lineChart');
          new Chart(ctxLine, {
            type: 'line',
            data: {
              labels: labels,
              datasets: [{
                label: 'Total Penjualan per Tanggal',
                data: dataTotals,
                borderColor: 'green',
                tension: 0.3
              }]
            },
            options: {
              scales: {
                x: {
                  type: 'time',
                  time: {
                    unit: 'day',
                    tooltipFormat: 'yyyy-MM-dd',
                    displayFormats: { day: 'dd' }
                  },
                  title: {
                    display: true,
                    text: 'Tanggal'
                  }
                },
                y: {
                  beginAtZero: true,
                  title: {
                    display: true,
                    text: 'Total Penjualan'
                  }
                }
              },
              plugins: {
                legend: { position: 'top' }
              }
            }
          });
        });
    }

    line()
  </script>
@endsection

