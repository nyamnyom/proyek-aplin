@extends('Layout.layout-admin')

@section('title', 'Manajemen Pegawai')

@section('content')
  <!-- Header -->

    <h2 class="fw-bold">Manajemen Pegawai</h4>
    <div class="row mt-4">
      <!-- List Pegawai -->
      <div class="col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="input-group w-75">

          </div>
          <button class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#modalPegawai" >
            <i class="fas fa-user-plus me-1"></i> Tambah
          </button>
        </div>
        <div class="list-group overflow-auto border" style="max-height: 66vh;" id="employeeList">
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
                <tr><td>Shift</td><td>-</td></tr>
              </tbody>
            </table>
            <button class="btn btn-danger" id="editPegawai" disabled>
              <i class="fas fa-pencil"></i> Edit Informasi Pegawai
            </button>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal Tambah Pegawai-->
  <div class="modal fade" id="modalPegawai" tabindex="-1" aria-labelledby="modalPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" onsubmit="addEmployee(event)">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPegawaiLabel">Tambah Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" class="form-control" id="idInput" hidden/>
          </div>
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
          <div class="mb-3">
            <label class="form-label">Shift Per Hari</label>
            <div id="shiftContainer">
              <!-- Hari akan di-generate lewat JavaScript -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Simpan</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function getData() {
      Promise.all([
        fetch('/user').then(res => {
          if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
          return res.json();
        }),
        fetch('/shift').then(res => {
          if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
          return res.json();
        })
      ])
      .then(([usersArray, shiftsResponse]) => {
        // Tangani kalau response shift bukan array langsung
        const shiftsArray = Array.isArray(shiftsResponse) ? shiftsResponse : (shiftsResponse.data || []);
      
        usersArray.forEach(user => {
          user.shifts = shiftsArray.filter(shift => shift.user_id === user.id);
        });
      
        window.employees = usersArray;
        console.log('Merged users with shifts:', window.employees);
      
        loadEmployees();
      })
      .catch(err => {
        console.error('Fetch error:', err);
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

      let shiftsHtml = '';

      if (emp.shifts && emp.shifts.length > 0) {
        shiftsHtml = '<table class="table table-bordered"><thead><tr><th scope="col">Hari</th><th scope="col">Jam Masuk</th><th scope="col">Jam Selesai</th></tr></thead>';
        emp.shifts.forEach(shift => {
          shiftsHtml += `
            <tr>
              <td>${shift.hari_masuk}</td>
              <td>${shift.jam_masuk}</td>
              <td>${shift.jam_pulang}</td>
            </tr>
          `;
        });
        shiftsHtml += '</tbody></table>';
      } else {
        shiftsHtml = '<i>Tidak ada shift</i>';
      }

      document.getElementById('detailPegawai').innerHTML = `
        <tr><td>ID</td><td>${emp.id}</td></tr>
        <tr><td>Nama</td><td>${emp.nama}</td></tr>
        <tr><td>Posisi</td><td>${emp.posisi}</td></tr>
        <tr><td>Status</td><td>${emp.is_active == 1 ? 'Aktif' : 'Non Aktif'}</td></tr>
        <tr><td>Shift</td><td>${shiftsHtml}</td></tr>
      `;
      document.getElementById('editPegawai').disabled = false;
      document.getElementById('editPegawai').onclick = () => openEditModal(emp);
    }

    function openEditModal(emp) {
      document.getElementById('idInput').value = emp.id;
      document.getElementById('usernameInput').value = emp.username;
      document.getElementById('namaInput').value = emp.nama;
      document.getElementById('positionInput').value = emp.posisi;

      // Kalau password memang tersedia di data emp.password
      document.getElementById('passwordInput').value = '*********' || '';

      // Buat username, nama, posisi readonly
      document.getElementById('usernameInput').readOnly = true;
      document.getElementById('namaInput').readOnly = true;
      document.getElementById('positionInput').readOnly = true;

      // Password TIDAK readonly supaya bisa diedit
      document.getElementById('passwordInput').readOnly = false;

      // Shift checkbox tetap aktif dan bisa diedit
      document.querySelectorAll('.shift-check').forEach(cb => {
        cb.checked = false;
        cb.disabled = false;
      });
      document.querySelectorAll('.shift-select').forEach(sel => {
        sel.disabled = true;
        sel.value = '';
      });
    
      if (emp.shifts && emp.shifts.length > 0) {
        emp.shifts.forEach(shift => {
          const hari = shift.hari_masuk;
          const checkbox = document.getElementById(`check-${hari}`);
          const select = document.getElementById(`shift-${hari}`);
        
          if (checkbox && select) {
            checkbox.checked = true;
            select.disabled = false;
          
            const jamMasuk = shift.jam_masuk.slice(0, 5);
            const jamPulang = shift.jam_pulang.slice(0, 5);
          
            const value = `${jamMasuk}-${jamPulang}`;
            select.value = value;
          }
        });
      }
    
      document.getElementById('modalPegawaiLabel').innerText = 'Edit Pegawai';
      document.querySelector('#modalPegawai button[type="submit"]').innerText = 'Update';
    
      const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPegawai'));
      modal.show();
    }

    function openAddModal() {
      // Bersihkan input
      document.getElementById('idInput').value = '';
      document.getElementById('usernameInput').value = '';
      document.getElementById('namaInput').value = '';
      document.getElementById('positionInput').value = '';
      document.getElementById('passwordInput').value = '';

      document.getElementById('usernameInput').readOnly = false;
      document.getElementById('namaInput').readOnly = false;
      document.getElementById('positionInput').readOnly = false;

      document.querySelectorAll('.shift-check').forEach(cb => cb.checked = false);
      document.querySelectorAll('.shift-select').forEach(sel => {
        sel.disabled = true;
        sel.value = '';
      });
    
      document.getElementById('modalPegawaiLabel').innerText = 'Tambah Pegawai';
      document.querySelector('#modalPegawai button[type="submit"]').innerText = 'Simpan';
    
      const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPegawai'));
      modal.show();
    }

    async function hapusShiftUser(userId) {
      try {
        const response = await fetch(`/shift/deleteByUser/${userId}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        });
      
        if (!response.ok) throw new Error(`Gagal hapus shift (status: ${response.status})`);
      
        const result = await response.json();
        console.log(result.message);
        alert('Shift berhasil dihapus');
      } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus shift');
      }
    }

    async function addEmployee(event) {
      event.preventDefault();
    
      const id = document.getElementById('idInput').value;
      const isEdit = id !== '';
    
      // Hanya ambil data user jika bukan edit
      const data = {
        username: document.getElementById('usernameInput').value,
        nama: document.getElementById('namaInput').value,
        posisi: document.getElementById('positionInput').value,
        password: document.getElementById('passwordInput').value
      };
    
      let userId = id;
    
      try {
        // Jika bukan edit, lakukan insert user
        if (!isEdit) {
          const response = await fetch('/user', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(data),
          });
        
          if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
          const user = await response.json();
          userId = user.user.id;
        }
      
        if (isEdit) {
          await hapusShiftUser(userId);
        }
      
        const hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
      
        for (const hari of hariList) {
          const isChecked = document.getElementById(`check-${hari}`).checked;
          const shiftValue = document.getElementById(`shift-${hari}`).value;
        
          if (isChecked && shiftValue) {
            const [jam_masuk, jam_pulang] = shiftValue.split('-');
          
            await fetch('/shift', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              },
              body: JSON.stringify({
                user_id: userId,
                hari_masuk: hari,
                jam_masuk: jam_masuk,
                jam_pulang: jam_pulang,
              }),
            });
          }
        }
      
        alert(isEdit ? 'Shift berhasil diupdate' : 'Data pegawai & shift berhasil disimpan');
        getData();
      
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPegawai'));
        modal.hide();
      
        // Reset form
        document.getElementById('idInput').value = '';
        document.getElementById('usernameInput').value = '';
        document.getElementById('namaInput').value = '';
        document.getElementById('positionInput').value = '';
        document.getElementById('passwordInput').value = '';
      
        hariList.forEach(hari => {
          document.getElementById(`check-${hari}`).checked = false;
          const shiftSelect = document.getElementById(`shift-${hari}`);
          shiftSelect.value = '';
          shiftSelect.disabled = true;
        });
      
      } catch (error) {
        console.error('Error:', error);
        alert('Gagal menyimpan data');
      }
    }

    const hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    const shiftContainer = document.getElementById('shiftContainer');

    hariList.forEach(hari => {
      const row = document.createElement('div');
      row.className = 'row align-items-center mb-2';

      row.innerHTML = `
        <div class="col-md-3">
          <div class="form-check">
            <input class="form-check-input shift-check" type="checkbox" id="check-${hari}" value="${hari}">
            <label class="form-check-label" for="check-${hari}">${hari}</label>
          </div>
        </div>
        <div class="col-md-9">
          <select class="form-select shift-select" id="shift-${hari}" disabled>
            <option value="">Pilih Shift</option>
            <option value="10:00-16:00">10:00 - 16:00</option>
            <option value="16:00-22:00">16:00 - 22:00</option>
          </select>
        </div>
      `;

      shiftContainer.appendChild(row);
    });

    // Logika aktif/nonaktifkan select shift berdasarkan checkbox
    shiftContainer.addEventListener('change', (e) => {
      if (e.target.classList.contains('shift-check')) {
        const hari = e.target.value;
        const select = document.getElementById(`shift-${hari}`);
        select.disabled = !e.target.checked;
        if (!e.target.checked) {
          select.value = ""; // reset jika tidak dipilih
        }
      }
    });
  </script>
@endsection
