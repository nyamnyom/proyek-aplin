@extends('Layout.layout-admin')

@section('title', 'Daftar Event')

@section('content')
    <h2 class="fw-bold">Daftar Promo</h4>
    <div class="mb-3">
      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addEventModal">
        <i class="bi bi-plus-circle"></i> Tambah Promo
      </button>
    </div>
    <div class="row mt-4">
      <!-- List Event -->
      <div class="col-md-7">
        <div id="eventList" class="list-group overflow-auto border" style="max-height: 66vh;">
          <!-- Event akan dimuat di sini -->
        </div>
      </div>
      <!-- Detail Event -->
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <h6 class="fw-bold" id="eventTitle">Pilih Promo</h6>
            <table class="table mt-3">
              <tbody id="eventDetail">
                <tr><td>Kode Promo</td><td>-</td></tr>
                <tr><td>Tanggal Mulai</td><td>-</td></tr>
                <tr><td>Tanggal Selesai</td><td>-</td></tr>
                <tr><td>Deskripsi</td><td>-</td></tr>
              </tbody>
            </table>
            <button class="btn btn-danger" id="editPromo" disabled>
              <i class="fas fa-pencil"></i> Edit Promo
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
      
  <!-- Modal Tambah Event -->
  <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="eventForm" onsubmit="savePromo(event)">
          <div class="modal-header">
            <h5 class="modal-title" id="addEventModalLabel">Tambah Promo Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <input type="text" class="form-control" id="eventId" hidden />
          <div class="modal-body">
            <div class="mb-3">
              <label for="eventName" class="form-label">Nama Promo</label>
              <input type="text" class="form-control" id="eventName" required />
            </div>
            <div class="mb-3">
              <label for="eventName" class="form-label">Kode Promo</label>
              <input type="text" class="form-control" id="eventKode" required />
            </div>
            <div class="mb-3">
              <label for="eventMulai" class="form-label">Tanggal Mulai</label>
              <input type="date" class="form-control" id="eventMulai" required />
            </div>
            <div class="mb-3">
              <label for="eventSelesai" class="form-label">Tanggal Selesai</label>
              <input type="date" class="form-control" id="eventSelesai" required />
            </div>
            <div class="mb-3">
              <label for="eventDesc" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="eventDesc" rows="2" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function loadPromo() {
      fetch('/promo')
        .then(res => {
          if (!res.ok) throw new Error('Fetch error');
          return res.json();
        })
        .then(data => {
          console.log(data)
          loadEvents(data);
        })
        .catch(err => console.error(err));
    }

    function loadEvents(events) {
      const list = document.getElementById('eventList');
      list.innerHTML = '';
    
      const today = new Date();
      today.setHours(0, 0, 0, 0);
    
      events.forEach(event => {
        const startDate = new Date(event.tanggal_mulai);
        startDate.setHours(0, 0, 0, 0);
      
        const endDate = new Date(event.tanggal_selesai);
        endDate.setHours(0, 0, 0, 0);
      
        if (endDate < today || startDate > today) {
          if (event.is_active === 1) {
            fetch(`/promo/${event.id}`, {
              method: 'PUT',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              body: JSON.stringify({ ...event, is_active: 0 })
            })
            .then(res => res.json())
            .then(data => {
              console.log(`Promo ${event.nama_promo} diupdate is_active=0 karena sudah berlalu atau belum mulai`);
            })
            .catch(err => console.error('Error updating promo is_active:', err));
          }
        } else { //set promo aktif
          if (event.is_active == 0) {
            fetch(`/promo/${event.id}`, {
              method: 'PUT',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              body: JSON.stringify({ ...event, is_active: 1 })
            })
            .then(res => res.json())
            .then(data => {
              console.log(`Promo ${event.nama_promo} diupdate is_active=1 karena sedang aktif`);
            })
            .catch(err => console.error('Error updating promo is_active:', err));
          }
        }
      
        showPromo(event, list)
      });
    }

    window.onload = loadPromo;

    function showPromo(event, list){
      const item = document.createElement('a');
      item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-start flex-column';

      const header = document.createElement('div');
      header.className = 'd-flex justify-content-between w-100';

      const promoTitle = document.createElement('strong');
      promoTitle.textContent = event.nama_promo;

      const badge = document.createElement('span');

      if (event.is_active) {
        promoTitle.classList.add('text-dark'); // Nama promo aktif
        badge.className = 'badge bg-success';
        badge.textContent = 'Aktif';
      } else {
        promoTitle.classList.add('text-secondary'); // Nama promo tidak aktif
        badge.className = 'badge bg-secondary';
        badge.textContent = 'Tidak Aktif';
      }

      header.appendChild(promoTitle);
      header.appendChild(badge);

      item.appendChild(header);

      const tanggal = document.createElement('small');
      tanggal.className = 'text-muted';
      tanggal.textContent = event.tanggal_mulai;
      item.appendChild(tanggal)

      item.onclick = () => showEvent(event);
      list.appendChild(item);
    }

    function showEvent(event) {
        document.getElementById('eventTitle').innerText = event.nama_promo;
        document.getElementById('eventDetail').innerHTML = `
          <tr><td>Kode Promo</td><td>${event.kode_promo}</td></tr>
          <tr><td>Tanggal Mulai</td><td>${event.tanggal_mulai}</td></tr>
          <tr><td>Tanggal Selesai</td><td>${event.tanggal_selesai}</td></tr>
          <tr><td>Deskripsi</td><td>${event.deskripsi}</td></tr>
        `;
        document.getElementById('editPromo').disabled = false;
        document.getElementById('editPromo').onclick = () => {
          document.getElementById('eventId').value = event.id || '';
          document.getElementById('eventName').value = event.nama_promo;
          document.getElementById('eventKode').value = event.kode_promo;
          document.getElementById('eventMulai').value = event.tanggal_mulai;
          document.getElementById('eventSelesai').value = event.tanggal_selesai;
          document.getElementById('eventDesc').value = event.deskripsi;

          document.getElementById('eventName').setAttribute('readonly', true);
          document.getElementById('eventId').setAttribute('readonly', true); // walau hidden, supaya aman
  
          document.getElementById('eventKode').removeAttribute('readonly');
          document.getElementById('eventMulai').removeAttribute('readonly');
          document.getElementById('eventSelesai').removeAttribute('readonly');
          document.getElementById('eventDesc').removeAttribute('readonly');

          const modal = new bootstrap.Modal(document.getElementById('addEventModal'));
          modal.show();
        };
    }

    function savePromo() {
      event.preventDefault(); 

      const eventId = document.getElementById('eventId').value;
      const tanggalMulai = new Date(document.getElementById('eventMulai').value);
      const tanggalSelesai = new Date(document.getElementById('eventSelesai').value);
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      if (tanggalSelesai < tanggalMulai) {
        alert("Tanggal promo tidak valid!");
        return;
      }

      const data = {
        nama_promo: document.getElementById('eventName').value,
        kode_promo: document.getElementById('eventKode').value,
        deskripsi: document.getElementById('eventDesc').value,
        tanggal_mulai: document.getElementById('eventMulai').value,
        tanggal_selesai: document.getElementById('eventSelesai').value,
        is_active: 1
      };

      const method = eventId ? 'PUT' : 'POST';
      const url = eventId ? `/promo/${eventId}` : '/promo';
    
      fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(data => {
        alert(data.message);

        //refresh table
        loadPromo(); 

        //hide modal
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('addEventModal'));
        modal.hide();

        //reset form
        document.getElementById('eventId').value = '';
        document.getElementById('eventName').value = '';
        document.getElementById('eventKode').value = '';
        document.getElementById('eventMulai').value = '';
        document.getElementById('eventSelesai').value = '';
        document.getElementById('eventDesc').value = '';
      })
      .catch(err => console.error(err));
    }

  </script>
@endsection