@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Reservasi Meja')

@section('content')
    <div class="row g-0">
      
      <!-- Main Content -->
      <div class="main-content" style="height: 100vh; overflow-y: auto;">
        <!-- Content Area -->
        <div class="content-area">
          <div class="content-header">
            <div>
              <h4>Reservasi Meja</h4>
            </div>
            <div>
              <button class="btn btn-outline-secondary me-2">Cancel</button>
              <button class="btn btn-danger">Tambah Reservasi</button>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12">
              <div class="reservation-form">
                <div class="mb-3">
                  <div class="d-flex gap-2">
                    <div class="input-group">
                      <input type="date" class="form-control">
                    </div>
                    <div class="input-group">
                      <input type="time" class="form-control">
                    </div>
                  </div>

                </div>
                
                <div class="mb-3">
                  <label class="form-label">Nama Pelanggan</label>
                  <input type="text" class="form-control" placeholder="Masukkan nama pelanggan...">
                </div>
                
                <div class="mb-3">
                  <label class="form-label">Nomor HP / Telepon</label>
                  <input type="text" class="form-control" placeholder="Masukkan nomor hp / telepon...">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        
@endsection

@section('scripts')
  <script>
    // Fungsi untuk menghandle seleksi tanggal
    document.querySelectorAll('.calendar-days div').forEach(day => {
      if (day.innerText) {
        day.addEventListener('click', function() {
          document.querySelectorAll('.calendar-days div').forEach(d => {
            d.classList.remove('selected');
          });
          this.classList.add('selected');
        });
      }
    });
    
    // Fungsi untuk menghandle toggle AM/PM
    document.querySelectorAll('.time-toggle button').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.time-toggle button').forEach(b => {
          b.classList.remove('active');
        });
        this.classList.add('active');
      });
    });
    
    // Fungsi untuk menghandle seleksi meja
    document.querySelectorAll('.table-item').forEach(table => {
      if (!table.classList.contains('reserved')) {
        table.addEventListener('click', function() {
          document.querySelectorAll('.table-item').forEach(t => {
            if (!t.classList.contains('reserved')) {
              t.classList.remove('selected');
              t.classList.add('available');
            }
          });
          this.classList.remove('available');
          this.classList.add('selected');
        });
      }
    });
  </script>
@endsection