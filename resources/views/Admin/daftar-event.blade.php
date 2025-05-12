@extends('Layout.layout-admin')

@section('title', 'Daftar Event')

@section('content')
  <div class="container-fluid py-4">
    <h4 class="fw-bold">Daftar Event</h4>
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
                <tr><td>Diskon</td><td>-</td></tr>
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
        <form id="eventForm">
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
              <label for="eventDate" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="eventDate" required />
            </div>
            <div class="mb-3">
              <label for="eventDesc" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="eventDesc" rows="2" required></textarea>
            </div>
            <div class="mb-3">
              <label for="eventDiscount" class="form-label">Diskon (%)</label>
              <input type="number" class="form-control" id="eventDiscount" required />
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
    let events = [
      { id: 'EVT001', name: 'Diskon Akhir Tahun', date: '2025-12-31', desc: 'Diskon besar-besaran akhir tahun.', discount: '20%' },
      { id: 'EVT002', name: 'Promo Hari Kasih Sayang', date: '2025-02-14', desc: 'Spesial untuk pasangan, menu diskon.', discount: '15%' },
      { id: 'EVT003', name: 'Ulang Tahun Restoran', date: '2025-05-01', desc: 'Rayakan ulang tahun restoran dengan promo menarik.', discount: '25%' },
      { id: 'EVT004', name: 'Ramadan Spesial', date: '2025-03-10', desc: 'Paket berbuka puasa diskon spesial.', discount: '30%' },
      { id: 'EVT005', name: 'Promo Gajian', date: '2025-04-25', desc: 'Spesial akhir bulan, semua menu diskon.', discount: '10%' }
    ];

    function loadEvents() {
      const list = document.getElementById('eventList');
      list.innerHTML = '';
      events.forEach(event => {
        const item = document.createElement('a');
        item.href = '#';
        item.className = 'list-group-item list-group-item-action';
        item.onclick = () => showEvent(event);
        item.innerHTML = `<strong>${event.name}</strong><br/><small>${event.date}</small>`;
        list.appendChild(item);
      });
    }

    function showEvent(event) {
      document.getElementById('eventTitle').innerText = event.name;
      document.getElementById('eventDetail').innerHTML = `
        <tr><td>Nama</td><td>${event.name}</td></tr>
        <tr><td>Tanggal</td><td>${event.date}</td></tr>
        <tr><td>Deskripsi</td><td>${event.desc}</td></tr>
        <tr><td>Diskon</td><td>${event.discount}</td></tr>
      `;
    }

    document.getElementById('eventForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const name = document.getElementById('eventName').value.trim();
      const date = document.getElementById('eventDate').value;
      const desc = document.getElementById('eventDesc').value.trim();
      const discount = document.getElementById('eventDiscount').value.trim();

      if (name && date && desc && discount) {
        const newEvent = {
          id: 'EVT' + String(events.length + 1).padStart(3, '0'),
          name,
          date,
          desc,
          discount: discount + '%'
        };
        events.push(newEvent);
        loadEvents();
        showEvent(newEvent);
        document.getElementById('eventForm').reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById('addEventModal'));
        modal.hide();
      }
    });

    loadEvents();
  </script>
@endsection