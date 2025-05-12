@extends('Layout.layout-admin')

@section('title', 'Daftar Event')

@section('content')
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
@endsection

@section('scripts')
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
      if (!id || !name || !position || !email) return alert('Lengkapi semua data!') ;

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
@endsection
