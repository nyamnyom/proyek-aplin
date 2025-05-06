<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Bahan</title>
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
            <li class="nav-item mb-2"><a class="nav-link" href="manajemen-pegawai"><i class="bi bi-people-fill"></i> Manajemen Pegawai</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="daftar-event"><i class="fas fa-calendar"></i> Daftar Event</a></li>
            <li class="nav-item mb-2"><a class="nav-link active" href="inventaris"><i class="bi bi-cart-fill"></i> Inventaris</a></li>
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

        <!-- Konten halaman di sini -->
        <!-- Sidebar dan Navbar sudah diasumsikan terpasang -->
        <div class="container-fluid px-4 py-4">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold">Data Master Bahan</h4>
      <small class="text-muted">Main Menu / Inventaris Bahan / <span class="text-danger">Tambah Bahan Baru</span></small>
    </div>
    <div>
      <a href="inventaris" class="btn btn-outline-danger me-2">Cancel</a>
      <a href="inventaris" id="submitBtn" class="btn btn-danger text-light disabled" onclick="return false;">Tambah Bahan</a>
    </div>
  </div>

  <!-- Form -->
  <div class="row">
    <!-- Kiri -->
    <div class="col-md-8">
      <div class="card p-4 mb-4 shadow-sm rounded-4">
        <h5 class="mb-4 fw-semibold">Bahan #B099</h5>
        <div class="mb-3">
          <label class="form-label">Nama Bahan</label>
          <input type="text" class="form-control" id="namaBahan" placeholder="Masukkan nama menu...">
        </div>
        <div class="row g-3">
          <div class="col-md-8">
            <label class="form-label">Minimal Stok Bahan</label>
            <input type="number" class="form-control" id="stokBahan" placeholder="Masukkan minimal stok bahan...">
          </div>
          <div class="col-md-4">
            <label class="form-label">Satuan</label>
            <select class="form-select" id="satuanBahan">
              <option selected disabled>Pilih satuan</option>
              <option>kg</option>
              <option>butir</option>
              <option>liter</option>
              <option>pak</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Kanan -->
    <div class="col-md-4">
      <div class="card p-4 shadow-sm rounded-4">
        <div class="mb-3">
          <label class="form-label">Harga Bahan</label>
          <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" class="form-control" id="hargaBahan" placeholder="Masukkan harga bahan...">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori Bahan</label>
          <select class="form-select" id="kategoriBahan">
            <option selected disabled>Pilih kategori</option>
            <option>Daging Mentah</option>
            <option>Organ Dalam Daging</option>
            <option>Lemak & Lainnya</option>
            <option>Bahan Pokok</option>
            <option>Sayuran</option>
            <option>Karbodirat</option>
            <option>Buah</option>
            <option>Daun Teh</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Status Bahan</label>
          <select class="form-select" id="statusBahan">
            <option selected disabled>Pilih status</option>
            <option>Tersedia</option>
            <option>Kurang</option>
            <option>Habis</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const fields = [
    'namaBahan',
    'stokBahan',
    'satuanBahan',
    'hargaBahan',
    'kategoriBahan',
    'statusBahan'
  ];

  const submitBtn = document.getElementById('submitBtn');

  function validateForm() {
    let isValid = true;

    fields.forEach(id => {
      const field = document.getElementById(id);
      if (!field.value || field.value.includes("Pilih")) {
        isValid = false;
      }
    });

    if (isValid) {
      submitBtn.classList.remove('disabled');
      submitBtn.onclick = () => true; // allow navigation
    } else {
      submitBtn.classList.add('disabled');
      submitBtn.onclick = () => false; // prevent navigation
    }
  }

  fields.forEach(id => {
    const field = document.getElementById(id);
    field.addEventListener('input', validateForm);
    field.addEventListener('change', validateForm);
  });

  validateForm(); // initial check
</script>



      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
