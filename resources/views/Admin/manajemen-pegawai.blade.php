@extends('Layout.layout-admin')

@section('title', 'Manajemen Pegawai')

@section('content')
  <!-- Header -->
  <div class="container-fluid py-4">
    <h4 class="fw-bold">Manajemen Pegawai</h4>
    <div class="row mt-4">
      <!-- List Pegawai -->
      <div class="col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="input-group w-75">

          </div>
          <button class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#modalPegawai">
            <i class="fas fa-user-plus me-1"></i> Tambah
          </button>
        </div>
        <div class="list-group" id="employeeList">
          {{-- data masuk disini --}}
        </div>
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
                <tr><td>Status</td><td>-</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Pegawai (blum)-->
  <div class="modal fade" id="modalPegawai" tabindex="-1" aria-labelledby="modalPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" onsubmit="addEmployee(event)">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPegawaiLabel">Tambah Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="usernameInput" class="form-label">Username</label>
            <input type="text" class="form-control" id="usernameInput" required />
          </div>
          <div class="mb-3">
            <label for="namaInput" class="form-label">Nama</label>
            <input type="text" class="form-control" id="namaInput" required />
          </div>
          <div class="mb-3">
            <label for="positionInput" class="form-label">Posisi</label>
            <input type="text" class="form-control" id="positionInput" required />
          </div>
          <div class="mb-3">
            <label for="passwordInput" class="form-label">Password</label>
            <input type="text" class="form-control" id="passwordInput" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Tambah</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function getData() {
      fetch('/user')
        .then(response => {
          if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
          return response.json();
        })
        .then(usersArray => {
          window.employees = usersArray;  // simpan global
          console.log('Data tersimpan di window.employees:', window.employees);

          // Panggil loadEmployees DI SINI supaya dijalankan setelah data ada
          loadEmployees();
        })
        .catch(error => {
          console.error('Fetch error:', error);
        });
    }

    function loadEmployees() {
      const list = document.getElementById('employeeList');
      if (!list) {
        console.error('Elemen dengan id "employeeList" tidak ditemukan');
        return;
      }
    
      list.innerHTML = '';
    
      // pakai window.employees yang sudah disimpan di getData
      window.employees.forEach(emp => {
        const item = document.createElement('a');
        item.href = '#';
        item.className = 'list-group-item list-group-item-action';
        item.onclick = () => showDetail(emp);
        item.innerHTML = `<strong>${emp.id}</strong><br/><small>${emp.nama}</small>`;
        list.appendChild(item);
      });
    }

    // Mulai fetch data
    getData();
  
    function showDetail(emp) {
      document.getElementById('empDetail').innerText = `${emp.id} | ${emp.nama}`;
      document.getElementById('detailPegawai').innerHTML = `
        <tr><td>ID</td><td>${emp.id}</td></tr>
        <tr><td>Nama</td><td>${emp.nama}</td></tr>
        <tr><td>Posisi</td><td>${emp.posisi}</td></tr>
        <tr><td>Status</td><td>${emp.is_active == 1 ? 'Aktif' : 'Non Aktif'}</td></tr>
      `;
    }

    function addEmployee(event) {
      event.preventDefault();
      const id = document.getElementById('idInput').value.trim();
      const name = document.getElementById('namaInput').value.trim();
      const position = document.getElementById('positionInput').value.trim();
      if (!id || !name || !position) return alert('Lengkapi semua data!') ;

      employees.push({ id, name, position, 1 });
      loadEmployees();
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalPegawai'));
      modal.hide();
      document.getElementById('idInput').value = '';
      document.getElementById('namaInput').value = '';
      document.getElementById('positionInput').value = '';
    }

    

    loadEmployees();
  </script>
@endsection
