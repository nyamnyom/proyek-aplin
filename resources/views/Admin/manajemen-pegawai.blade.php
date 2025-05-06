<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manajemen Pegawai</title>
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
            <li class="nav-item mb-2"><a class="nav-link" href="riwayat-penjualan"><i class="fas fa-list-alt"></i> Riwayat Penjualan</a></li>
            <li class="nav-item mb-2"><a class="nav-link active" href="manajemen-pegawai"><i class="bi bi-people-fill"></i> Manajemen Pegawai</a></li>
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
            <input class="form-control search-bar" type="search" placeholder="Cari pelanggan..." aria-label="Search" />
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

      <!-- Header -->
      <div class="container-fluid py-4">
        <h4 class="fw-bold">Manajemen Pegawai</h4>
        <div class="row mt-4">
          <!-- List Pegawai -->
          <div class="col-md-7">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="input-group w-75">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari nama atau ID pegawai" onkeyup="searchEmployee()" />
                <button class="btn btn-outline-secondary" type="button">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <button class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#modalPegawai">
                <i class="fas fa-user-plus me-1"></i> Tambah
              </button>
            </div>
            <div class="list-group" id="employeeList"></div>
          </div>

          <!-- Detail Pegawai -->
          <div class="col-md-5">
            <div class="card">
              <div class="card-body">
                <h6 class="fw-bold" id="empDetail">Pilih pegawai</h6>
                <table class="table mt-3">
                  <tbody id="detailPegawai">
                    <tr><td>ID</td><td>-</td></tr>
                    <tr><td>Nama</td><td>-</td></tr>
                    <tr><td>Posisi</td><td>-</td></tr>
                    <tr><td>Email</td><td>-</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Tambah Pegawai -->
      <div class="modal fade" id="modalPegawai" tabindex="-1" aria-labelledby="modalPegawaiLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="modal-content" onsubmit="addEmployee(event)">
            <div class="modal-header">
              <h5 class="modal-title" id="modalPegawaiLabel">Tambah Pegawai</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="idInput" class="form-label">ID Pegawai</label>
                <input type="text" class="form-control" id="idInput" required />
              </div>
              <div class="mb-3">
                <label for="nameInput" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nameInput" required />
              </div>
              <div class="mb-3">
                <label for="positionInput" class="form-label">Posisi</label>
                <input type="text" class="form-control" id="positionInput" required />
              </div>
              <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" required />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Tambah</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
const employees = [
  { id: 'EMP001', name: 'Rina', position: 'Kasir', email: 'rina@mail.com' },
  { id: 'EMP002', name: 'Budi', position: 'Koki', email: 'budi@mail.com' },
  { id: 'EMP003', name: 'Sinta', position: 'Waiter', email: 'sinta@mail.com' },
  { id: 'EMP004', name: 'Andi', position: 'Manajer', email: 'andi@mail.com' },
  { id: 'EMP005', name: 'Lina', position: 'Kasir', email: 'lina@mail.com' },
  { id: 'EMP006', name: 'Doni', position: 'Koki', email: 'doni@mail.com' },
  { id: 'EMP007', name: 'Tiara', position: 'Waiter', email: 'tiara@mail.com' },
  { id: 'EMP008', name: 'Agus', position: 'Manajer', email: 'agus@mail.com' },
  { id: 'EMP009', name: 'Fitri', position: 'Kasir', email: 'fitri@mail.com' },
  { id: 'EMP010', name: 'Reza', position: 'Koki', email: 'reza@mail.com' },
];

function loadEmployees() {
  const list = document.getElementById('employeeList');
  list.innerHTML = '';
  employees.forEach(emp => {
    const item = document.createElement('a');
    item.href = '#';
    item.className = 'list-group-item list-group-item-action';
    item.onclick = () => showDetail(emp);
    item.innerHTML = `<strong>${emp.id}</strong><br/><small>${emp.name}</small>`;
    list.appendChild(item);
  });
}

function showDetail(emp) {
  document.getElementById('empDetail').innerText = `${emp.id} | ${emp.name}`;
  document.getElementById('detailPegawai').innerHTML = `
    <tr><td>ID</td><td>${emp.id}</td></tr>
    <tr><td>Nama</td><td>${emp.name}</td></tr>
    <tr><td>Posisi</td><td>${emp.position}</td></tr>
    <tr><td>Email</td><td>${emp.email}</td></tr>
  `;
}

function searchEmployee() {
  const keyword = document.getElementById('searchInput').value.toLowerCase();
  const list = document.getElementById('employeeList');
  list.innerHTML = '';
  employees
    .filter(emp => emp.name.toLowerCase().includes(keyword) || emp.id.toLowerCase().includes(keyword))
    .forEach(emp => {
      const item = document.createElement('a');
      item.href = '#';
      item.className = 'list-group-item list-group-item-action';
      item.onclick = () => showDetail(emp);
      item.innerHTML = `<strong>${emp.id}</strong><br/><small>${emp.name}</small>`;
      list.appendChild(item);
    });
}

function addEmployee(event) {
  event.preventDefault();
  const id = document.getElementById('idInput').value.trim();
  const name = document.getElementById('nameInput').value.trim();
  const position = document.getElementById('positionInput').value.trim();
  const email = document.getElementById('emailInput').value.trim();
  if (!id || !name || !position || !email) return alert('Lengkapi semua data!');

  employees.push({ id, name, position, email });
  loadEmployees();
  const modal = bootstrap.Modal.getInstance(document.getElementById('modalPegawai'));
  modal.hide();
  document.getElementById('idInput').value = '';
  document.getElementById('nameInput').value = '';
  document.getElementById('positionInput').value = '';
  document.getElementById('emailInput').value = '';
}

loadEmployees();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
