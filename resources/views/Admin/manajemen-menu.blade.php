@extends('Layout.layout-admin')

@section('title', 'Manajemen Menu')

@section('styles')
  <style>
    .menu_img{
      border-radius: 100%;
      height: 40px;
      width: 40px;
    }
  </style>
@endsection

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Manajemen Menu</h2>
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#menuModal" onclick="openForm()">+ Tambah Menu</button>
  </div>

  <table class="table table-bordered text-center align-middle">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Gambar Menu</th>
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
                <td><img src="{{asset($menu->image_url)}}" class="menu_img" alt="{{$menu->name}}" onerror="this.onerror=null;this.src='{{ asset('default_food.png') }}';"></td>
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
            <label for="image" class="form-label">Gambar Menu</label>
            <input type="file" class="form-control" id="image" name="image">
            <div id="error-image" style="color: red"></div>
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
        document.getElementById("error-image").innerHTML = "";
        document.getElementById("menuModalLabel").textContent = "Tambah Menu";
        document.getElementById("editIndex").value = "";
        document.getElementById("namaMenu").value = "";
        document.getElementById("kategori").value = "";
        document.getElementById("harga").value = "";
        document.getElementById("desc").value = "";
    } 

    function editMenu(index) {
        const data = listMenu[index];
        document.getElementById("menuModalLabel").textContent = "Edit Menu";
        document.getElementById("editIndex").value = data.id; // Menggunakan ID dari database
        document.getElementById("namaMenu").value = data.name;
        document.getElementById("kategori").value = data.category;
        document.getElementById("harga").value = data.price;
        document.getElementById("desc").value = data.description;
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
      document.getElementById("error-image").innerHTML = "";
      const id = document.getElementById("editIndex").value;

      const formData = new FormData();
      formData.append("name", document.getElementById("namaMenu").value);
      formData.append("kategori", document.getElementById("kategori").value);
      formData.append("harga", document.getElementById("harga").value);
      formData.append("deskripsi", document.getElementById("desc").value);

      const imageFile = document.getElementById("image").files[0];
      if (imageFile) {
          formData.append("image", imageFile);
      }
      // Kalau insert wajib memasukkan gambar
      else if (id == ""){
          document.getElementById("error-image").innerHTML = "Wajib Input Gambar";
          return false;
      }

      const url = id ? `/updateMenu/${id}` : '/insertMenu';

      fetch(url, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
      })
      .then(response => {
          if (!response.ok) throw new Error('Network response was not ok');
          return response.json();
      })
      .then(result => {
          if (result.success) {
              alert(result.message);
              location.reload();
          } else {
              alert(result.message || 'Terjadi kesalahan');
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