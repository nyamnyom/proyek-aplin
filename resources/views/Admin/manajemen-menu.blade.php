@extends('Layout.layout-admin')

@section('title', 'Manajemen Menu')

@section('content')
  <!-- Header -->
  <div class="mb-4">
    <h1 class="fw-bold">Manajemen Menu</h1>
    <small class="text-muted">Main Menu / <span class="text-danger">Laporan Pelanggan</span></small>
  </div>

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
      @if ($menus->isEmpty())
          <div class="alert alert-info">
              Menu tidak ditemukan
          </div>
      @else
          @php
            $count = 1;
          @endphp
          @foreach ($menus as $menu)
              <tr>
                <td>{{$count}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->category}}</td>
                <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                <td><span class="badge bg-{{ $menu->is_active === 1 ? 'success' : 'secondary' }}">{{ $menu->is_active === 1 ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td>
                  <button class="btn btn-sm btn-warning me-2" onclick="editMenu(${index})">Edit</button>
                  <button class="btn btn-sm btn-danger" onclick="deleteMenu(${index})">Hapus</button>
                </td>
              </tr>
              @php
                $count++;
              @endphp
          @endforeach
      @endif
    </tbody>
  </table>


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
@endsection

@section('scripts')
  <script>
    

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
@endsection