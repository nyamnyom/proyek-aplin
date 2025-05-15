@extends('Layout.layout-admin')

@section('title', 'Manajemen Menu')

@section('content')
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
          <input type="hidden" id="editId">
          <div class="mb-3">
            <label for="namaMenu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="namaMenu" required>
          </div>
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" required>
              <option value="">Pilih Kategori</option>
              <option value="Makanan">Makanan</option>
              <option value="Minuman">Minuman</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Harga (Rp)</label>
            <input type="number" class="form-control" id="harga" required>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" required>
              <option value="1">Tersedia</option>
              <option value="0">Habis</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="desc" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="desc" rows="2" required></textarea>
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
    let menuList = [];

    function loadData(){
      fetch('/menus')
        .then(response => {
          if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
          return response.json();
        })
        .then(data => {
          showMenu(data);
          menuList = data
          console.log(data)
        })
        .catch(error => {
          console.error('Fetch error:', error);
        });
    }

    function number_format(number, decimals, dec_point, thousands_sep) {
      const fixedNumber = Number(number).toFixed(decimals);
      const parts = fixedNumber.split('.');
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
      return parts.join(dec_point);
    }

    function showMenu(data) {
      const tableBody = data.map(menu => `
        <tr>
          <td>${menu.id}</td>
          <td>${menu.name}</td>
          <td>${menu.category}</td>
          <td>Rp ${number_format(menu.price, 0, ',', '.')}</td>
          <td>${menu.is_active == 1 ? 'Tersedia' : 'Habis'}</td>
          <td>
            <button class="btn btn-sm btn-warning me-2" onclick="editMenu(${menu.id -1})">Edit</button>
            <button class="btn btn-sm btn-danger" onclick="deleteMenu(${menu.id})">Hapus</button>
          </td>
        </tr>
      `).join('');
      
      document.getElementById('menuTable').innerHTML = tableBody;
    }

    function openForm() {
      document.getElementById("menuModalLabel").textContent = "Tambah Menu";
      document.getElementById("editId").value = "";
      document.getElementById("namaMenu").value = "";
      document.getElementById("kategori").value = "";
      document.getElementById("harga").value = "";
      document.getElementById("status").value = 1;
      document.getElementById("desc").value = "";
    } 

    function editMenu(index) {
      console.log(index)
      const data = menuList[index];
      document.getElementById("editId").value = data.id;
      document.getElementById("namaMenu").value = data.name;
      document.getElementById("kategori").value = data.category;
      document.getElementById("harga").value = data.price;
      document.getElementById("status").value = data.is_active;
      document.getElementById("desc").value = data.description;
      document.getElementById("menuModalLabel").textContent = "Edit Menu";
      new bootstrap.Modal(document.getElementById("menuModal")).show();
    } 

    function deleteMenu(id) {
      if (!confirm("Yakin ingin menghapus menu ini?")) return;
    
      fetch(`/menus/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
      })
      .then(response => {
        if (!response.ok) throw new Error('Gagal menghapus menu');
        return response.json();
      })
      .then(data => {
        alert(data.message);
        loadData(); // refresh data
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus');
      });
    }

    const menuModal = new bootstrap.Modal(document.getElementById("menuModal"));

function saveMenu(event) {
  event.preventDefault();

  const id = document.getElementById("editId").value;
  const name = document.getElementById("namaMenu").value;
  const category = document.getElementById("kategori").value;
  const price = Number(document.getElementById("harga").value);
  const is_active = document.getElementById("status").value;
  const description = document.getElementById("desc").value; 

  console.log('Saving menu id:', id);

  const data = {
    name: name,
    category: category,
    price: price,
    is_active: is_active,
    description: description
  };

const url = id ? `/menus/${id}` : `/menus`; // benar-benar tanpa slash di akhir

  fetch(url, {
    method: id ? 'PUT' : 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    if (!response.ok) throw new Error('Gagal menyimpan data');
    return response.json();
  })
  .then(result => {
    menuModal.hide();
    loadData();
  })
  .catch(error => {
    console.error('Detail error:', error);
    alert('Gagal menyimpan data');
  });
}


    loadData()
  </script>
@endsection