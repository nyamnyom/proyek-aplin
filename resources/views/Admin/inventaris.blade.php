<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inventaris</title>
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

        <!-- Master Bahan -->
        <div class="container-fluid mt-4 data-bahan">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="fw-bold">Data Master Bahan</h4>
              <small class="text-muted">Main Menu / <span class="text-danger">Inventaris Bahan</span></small>
            </div>
            <a href="tambah-bahan"><button class="btn btn-danger btn-lg">+ Tambah Bahan Baru</button></a>
            
          </div>

          <div class="card p-3">
            <div class="d-flex justify-content-between mb-3">
              <div class="input-group w-25">
                <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                <button class="btn btn-outline-secondary" onclick="filterTable()">🔍 Filter</button>
              </div>
              <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-secondary">Columns</button>
                <label class="form-label mb-0">Show</label>
                <select class="form-select w-auto">
                  <option>14</option>
                  <option>25</option>
                  <option>50</option>
                </select>
              </div>
            </div>

            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                  <tr>
                    <th>ID Bahan</th>
                    <th>Nama Bahan</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Pembelian Terakhir</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Contoh data diperbanyak -->
                  <tr>
                    <td>B001</td>
                    <td>Daging Babi</td>
                    <td>Daging Mentah</td>
                    <td>50 kg</td>
                    <td>Rp 80.000</td>
                    <td><span class="badge bg-success">Tersedia</span></td>
                    <td>6 November 2024<br><small class="text-muted">08:39:10</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <tr>
                    <td>B002</td>
                    <td>Paha Babi</td>
                    <td>Daging Mentah</td>
                    <td>3 kg</td>
                    <td>Rp 85.000</td>
                    <td><span class="badge bg-warning text-dark">Kurang</span></td>
                    <td>6 November 2024<br><small class="text-muted">08:39:21</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <tr>
                    <td>B003</td>
                    <td>Dada Babi</td>
                    <td>Daging Mentah</td>
                    <td>50 kg</td>
                    <td>Rp 90.000</td>
                    <td><span class="badge bg-success">Tersedia</span></td>
                    <td>6 November 2024<br><small class="text-muted">08:39:35</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <tr>
                    <td>B010</td>
                    <td>Tomat</td>
                    <td>Sayuran</td>
                    <td>0 kg</td>
                    <td>Rp 8.000</td>
                    <td><span class="badge bg-danger">Habis</span></td>
                    <td>6 November 2024<br><small class="text-muted">08:40:47</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <tr>
                    <td>B020</td>
                    <td>Telur Ayam</td>
                    <td>Bahan Pokok</td>
                    <td>200 butir</td>
                    <td>Rp 2.500</td>
                    <td><span class="badge bg-success">Tersedia</span></td>
                    <td>15 November 2024<br><small class="text-muted">20:50:51</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <tr>
                    <td>B025</td>
                    <td>Mie Telur</td>
                    <td>Karbohidrat</td>
                    <td>100 kg</td>
                    <td>Rp 18.000</td>
                    <td><span class="badge bg-success">Tersedia</span></td>
                    <td>20 November 2024<br><small class="text-muted">07:25:22</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <tr>
                    <td>B070</td>
                    <td>Jeruk Segar</td>
                    <td>Buah</td>
                    <td>7 kg</td>
                    <td>Rp 20.000</td>
                    <td><span class="badge bg-warning text-dark">Kurang</span></td>
                    <td>15 November 2024<br><small class="text-muted">20:51:02</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <tr>
                    <td>B071</td>
                    <td>Teh Hijau</td>
                    <td>Daun Teh</td>
                    <td>5 kg</td>
                    <td>Rp 18.000</td>
                    <td><span class="badge bg-warning text-dark">Kurang</span></td>
                    <td>15 November 2024<br><small class="text-muted">20:51:17</small></td>
                    <td><a href="edit-bahan"><i class="bi bi-pencil-square"></i> Edit</a></td>
                  </tr>
                  <!-- Tambahkan lebih banyak data jika mau -->
                </tbody>
              </table>
            </div>

            <nav class="mt-3">
              <ul class="pagination justify-content-end">
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function filterTable() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const rows = document.querySelectorAll("#dataTable tbody tr");

      rows.forEach(row => {
        const rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(input) ? "" : "none";
      });
    }
  </script>
</body>
</html>
