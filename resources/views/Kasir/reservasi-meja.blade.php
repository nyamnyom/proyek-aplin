@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Reservasi Meja')

@section('content')
    <div class="row g-0">
      
      <!-- Main Content -->
      <div class="main-content" style="overflow-y: auto; width: 96.5%">
        <!-- Content Area -->
        <div class="content-area">
          <div class="content-header">
              <h4>Reservasi Meja</h4>
          </div>
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
          <form method="POST" action="{{ route('kasir.insertReservasi') }}">
            @csrf
            <div class="mb-3">
              <div class="d-flex gap-2">
                <div class="input-group">
                  <input type="date" name="tanggal_reservasi" class="form-control" required>
                </div>
                <div class="input-group">
                  <input type="time" name="waktu_reservasi" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Nama Pelanggan</label>
              <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama pelanggan..." required>
            </div>

            <div class="mb-3">
              <label class="form-label">Nomor HP / Telepon</label>
              <input type="text" name="nomor_telepon" class="form-control" placeholder="Masukkan nomor hp / telepon..." required>
            </div>

            <div class="mb-3">
              <label class="form-label">Nomor Meja</label>
              <select name="nomor_meja" class="form-select" required>
                <option value="">Pilih Meja</option>
                @foreach (DB::table('meja')->get() as $meja)
                  <option value="{{ $meja->nomor_meja }}">{{ $meja->nomor_meja }} (Kapasitas: {{ $meja->kapasitas }})</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Jumlah Tamu</label>
              <input type="number" name="jumlah_tamu" class="form-control" placeholder="Masukkan jumlah tamu..." required>
            </div>

            <button type="submit" class="btn btn-danger">Simpan Reservasi</button>
          </form>
          
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