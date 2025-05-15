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
      @if ($menus->isEmpty())
          <div class="alert alert-info">
              Menu tidak ditemukan
          </div>
      @else
          @php
            $count = 1;
          @endphp
          @foreach ($menus as $index => $menu)
              <tr>
                <td>{{$count}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->category}}</td>
                <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                <td><span class="badge bg-{{ $menu->is_active === 1 ? 'success' : 'secondary' }}">{{ $menu->is_active === 1 ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td>
                    <button class="btn btn-sm btn-warning me-2" onclick="editMenu({{ $index }})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteMenu({{ $menu->id }})">Hapus</button>
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
      <form class="modal-content" onsubmit="saveMenu(event)" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="menuModalLabel">Tambah Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editIndex">
          
          <div class="mb-3">
            <label for="namaMenu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="namaMenu" name="name" placeholder="Nama Menu" required>
          </div>

          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
              <option value="">Pilih Kategori</option>
              <option value="Makanan">Makanan</option>
              <option value="Minuman">Minuman</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="harga" class="form-label">Harga (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Menu" min="1000" required>
          </div>

          <div class="mb-3">
            <label for="desc" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="desc" name="deskripsi" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="image_url" class="form-label">URL Gambar</label>
            <input type="text" class="form-control" id="image_url" name="image_url">
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
    listMenu = @json($menus);

    function openForm() {
      document.getElementById("menuModalLabel").textContent = "Tambah Menu";
      document.getElementById("editIndex").value = "";
      document.getElementById("namaMenu").value = "";
      document.getElementById("kategori").value = "";
      document.getElementById("harga").value = "";
      document.getElementById("desc").value = "";
      document.getElementById("image_url").value = "";
    } 

    function editMenu(index) {
        const data = listMenu[index];
        document.getElementById("menuModalLabel").textContent = "Edit Menu";
        document.getElementById("editIndex").value = data.id; // Menggunakan ID dari database
        document.getElementById("namaMenu").value = data.name;
        document.getElementById("kategori").value = data.category;
        document.getElementById("harga").value = data.price;
        document.getElementById("desc").value = data.description;
        document.getElementById("image_url").value = data.image_url;
        new bootstrap.Modal(document.getElementById("menuModal")).show();
    }

    function deleteMenu(id) {
        if (confirm("Yakin ingin menghapus menu ini?")) {
            fetch(`/deleteMenu/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert(result.message);
                    location.reload(); // Refresh untuk update data
                } else {
                    alert('Gagal menghapus menu');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus menu');
            });
        }
    }


    function saveMenu(e) {
      e.preventDefault();
      const id = document.getElementById("editIndex").value;
      
      const data = {
          name: document.getElementById("namaMenu").value,
          kategori: document.getElementById("kategori").value,
          harga: parseInt(document.getElementById("harga").value),
          deskripsi: document.getElementById("desc").value,
          image_url: document.getElementById('image_url').value,
          _token: document.querySelector('meta[name="csrf-token"]').content
      };

      // Pastikan URL sesuai
      const url = id ? `/updateMenu/${id}` : '/insertMenu';
      
      fetch(url, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': data._token
          },
          body: JSON.stringify(data)
      })
      .then(response => {
          if (!response.ok) {
              throw new Error('Network response was not ok');
          }
          return response.json();
      })
      .then(result => {
          if (result.success) {
              alert(result.message);
              location.reload();
          }
      })
      .catch(error => {
          console.error('Error:', error);
          alert('Error: ' + error.message);
      });

      bootstrap.Modal.getInstance(document.getElementById("menuModal")).hide();
    }


  </script>
@endsection