@extends('Layout.layout-admin')

@section('title', 'Inventaris')

@section('content')
    
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
          <div class="d-inline-block">
            <select class="form-select form-select-sm" style="min-width: 80px;">
              <option>14</option>
              <option>25</option>
              <option>50</option>
            </select>
          </div>
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
@endsection

@section('scripts')
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
@endsection
