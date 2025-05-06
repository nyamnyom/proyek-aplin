<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Menu</title>
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
            <li class="nav-item mb-2"><a class="nav-link active" href="manajemen-menu"><i class="bi bi-egg-fried"></i> Manajemen Menu</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="riwayat-penjualan"><i class="fas fa-list-alt"></i> Riwayat Penjualan</a></li>
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

      <!-- Header -->
      <div class="mb-4">
        <h1 class="fw-bold">Manajemen Menu</h1>
        <small class="text-muted">Main Menu / <span class="text-danger">Laporan Pelanggan</span></small>
      </div>

      <div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Manajemen Menu</h2>
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#menuModal" onclick="openForm()">+ Tambah Menu</button>
  </div>

  <table class="table table-bordered text-center align-middle">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="menuTable">
      <!-- Data akan di-generate oleh JS -->
    </tbody>
  </table>
</div>

<!-- Modal Tambah/Edit Menu -->
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" onsubmit="saveMenu(event)">
      <div class="modal-header">
        <h5 class="modal-title" id="menuModalLabel">Tambah Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editIndex">
        <div class="mb-3">
          <label for="namaMenu" class="form-label">Nama Menu</label>
          <input type="text" class="form-control" id="namaMenu" required>
        </div>
        <div class="mb-3">
          <label for="kategori" class="form-label">Kategori</label>
          <select class="form-select" id="kategori" required>
            <option value="">Pilih Kategori</option>
            <option>Makanan</option>
            <option>Minuman</option>
            <option>Dessert</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="harga" class="form-label">Harga (Rp)</label>
          <input type="number" class="form-control" id="harga" required>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" required>
            <option value="Tersedia">Tersedia</option>
            <option value="Habis">Habis</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
  let menuList = [
    { nama: "Nasi Semacem Babi", kategori: "Makanan", harga: 35000, status: "Tersedia" },
    { nama: "Nasi Chachu Babi", kategori: "Makanan", harga: 38000, status: "Tersedia" },
    { nama: "Mie Semacem Babi", kategori: "Makanan", harga: 32000, status: "Habis" },
    { nama: "Mie Chachu Babi", kategori: "Makanan", harga: 36000, status: "Tersedia" }
  ];

  function renderTable() {
    const table = document.getElementById("menuTable");
    table.innerHTML = "";
    menuList.forEach((item, index) => {
      table.innerHTML += `
        <tr>
          <td>${index + 1}</td>
          <td>${item.nama}</td>
          <td>${item.kategori}</td>
          <td>Rp ${item.harga.toLocaleString()}</td>
          <td><span class="badge bg-${item.status === "Tersedia" ? "success" : "secondary"}">${item.status}</span></td>
          <td>
            <button class="btn btn-sm btn-warning me-2" onclick="editMenu(${index})">Edit</button>
            <button class="btn btn-sm btn-danger" onclick="deleteMenu(${index})">Hapus</button>
          </td>
        </tr>
      `;
    });
  }

  function openForm() {
    document.getElementById("menuModalLabel").textContent = "Tambah Menu";
    document.getElementById("editIndex").value = "";
    document.getElementById("namaMenu").value = "";
    document.getElementById("kategori").value = "";
    document.getElementById("harga").value = "";
    document.getElementById("status").value = "Tersedia";
  }

  function editMenu(index) {
    const data = menuList[index];
    document.getElementById("editIndex").value = index;
    document.getElementById("namaMenu").value = data.nama;
    document.getElementById("kategori").value = data.kategori;
    document.getElementById("harga").value = data.harga;
    document.getElementById("status").value = data.status;
    document.getElementById("menuModalLabel").textContent = "Edit Menu";
    new bootstrap.Modal(document.getElementById("menuModal")).show();
  }

  function deleteMenu(index) {
    if (confirm("Yakin ingin menghapus menu ini?")) {
      menuList.splice(index, 1);
      renderTable();
    }
  }

  function saveMenu(e) {
    e.preventDefault();
    const index = document.getElementById("editIndex").value;
    const data = {
      nama: document.getElementById("namaMenu").value,
      kategori: document.getElementById("kategori").value,
      harga: parseInt(document.getElementById("harga").value),
      status: document.getElementById("status").value
    };

    if (index === "") {
      menuList.push(data);
    } else {
      menuList[index] = data;
    }

    bootstrap.Modal.getInstance(document.getElementById("menuModal")).hide();
    renderTable();
  }

  // Inisialisasi
  renderTable();

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
