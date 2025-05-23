@extends('Layout.layout-admin')

@section('title', 'Daftar Event')

@section('content')
    <h2 class="fw-bold">Daftar Event</h4>
    <div class="mb-3">
      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addEventModal">
        <i class="bi bi-plus-circle"></i> Tambah Event
      </button>
    </div>
    <div class="row mt-4">
      <!-- List Event -->
      <div class="col-md-7">
        <div class="list-group" id="eventList">
          <!-- Event akan dimuat di sini -->
        </div>
      </div>
      <!-- Detail Event -->
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <h6 class="fw-bold" id="eventTitle">Pilih Event</h6>
            <table class="table mt-3">
              <tbody id="eventDetail">
                <tr><td>Nama</td><td>-</td></tr>
                <tr><td>Tanggal</td><td>-</td></tr>
                <tr><td>Deskripsi</td><td>-</td></tr>
              </tbody>
            </table>
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
            <h5 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="eventName" class="form-label">Nama Event</label>
              <input type="text" class="form-control" id="eventName" required />
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
          loadEvents(data);
        })
        .catch(err => console.error(err));
    }

    function loadEvents(events) {
      const list = document.getElementById('eventList');
      list.innerHTML = '';
      events.forEach(event => {
        const item = document.createElement('a');
        item.className = 'list-group-item list-group-item-action';
        item.onclick = () => showEvent(event);
        item.innerHTML = `<strong>${event.nama_promo}</strong><br/><small>${event.tanggal_mulai}</small>`;
        list.appendChild(item);
      });
    }

    window.onload = loadPromo;

    function showEvent(event) {
      document.getElementById('eventTitle').innerText = event.nama_promo;
      document.getElementById('eventDetail').innerHTML = `
        <tr><td>Tanggal Mulai</td><td>${event.tanggal_mulai}</td></tr>
        <tr><td>Tanggal Selesai</td><td>${event.tanggal_selesai}</td></tr>
        <tr><td>Deskripsi</td><td>${event.deskripsi}</td></tr>
      `;
    }

    function savePromo() {
      event.preventDefault(); 

      const data = {
        nama_promo: document.getElementById('eventName').value,
        deskripsi: document.getElementById('eventDesc').value,
        tanggal_mulai: document.getElementById('eventMulai').value,
        tanggal_selesai: document.getElementById('eventSelesai').value,
        is_active: 1
      };
    
      fetch('/promo', {
        method: 'POST',
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
        document.getElementById('eventName').value = '';
        document.getElementById('eventMulai').value = '';
        document.getElementById('eventSelesai').value = '';
        document.getElementById('eventDesc').value = '';
      })
      .catch(err => console.error(err));
    }

  </script>
@endsection