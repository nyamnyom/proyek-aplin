@extends('Layout.layout-kasir')

@section('title', 'Wei Hong Restaurant - Reservasi Meja')

@section('content')
<div class="row g-0">
  <div class="main-content" style="overflow-y: auto; max-height: calc(100vh - 100px); width: 96.5%">
    <div class="content-area">
      <div class="content-header">
        <h4>Reservasi Meja</h4>
      </div>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form id="reservasi-form" method="POST" action="{{ route('kasir.insertReservasi') }}">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="POST">
        <input type="hidden" name="id" id="reservasi-id">

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

        <button type="submit" class="btn btn-danger" id="submit-btn">Simpan Reservasi</button>
        <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal Edit</button>
      </form>

      <div class="mt-4">
        <h5>Daftar Reservasi</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Nama Pelanggan</th>
              <th>Nomor Telepon</th>
              <th>Nomor Meja</th>
              <th>Jumlah Tamu</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reservasi as $item)
              <tr>
                <td>{{ $item->tanggal_reservasi }}</td>
                <td>{{ $item->waktu_reservasi }}</td>
                <td>{{ $item->nama_pelanggan }}</td>
                <td>{{ $item->nomor_telepon }}</td>
                <td>{{ $item->nomor_meja }}</td>
                <td>{{ $item->jumlah_tamu }}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-warning btn-edit"
                    data-id="{{ $item->id }}"
                    data-nama="{{ $item->nama_pelanggan }}"
                    data-telepon="{{ $item->nomor_telepon }}"
                    data-tanggal="{{ $item->tanggal_reservasi }}"
                    data-waktu="{{ $item->waktu_reservasi }}"
                    data-meja="{{ $item->nomor_meja }}"
                    data-jumlah="{{ $item->jumlah_tamu }}">
                    Edit
                  </button>
                  <form action="{{ route('kasir.deleteReservasi', $item->id) }}" method="GET" style="display:inline-block">                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus reservasi ini?')">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.btn-edit').forEach(button => {
  button.addEventListener('click', function () {
    const form = document.getElementById('reservasi-form');
    form.action = `{{ route('kasir.updateReservasi') }}`; // tetap arahkan ke update route
    document.getElementById('form-method').value = 'POST'; // karena kita pakai route POST (bukan PUT)
    document.getElementById('reservasi-id').value = this.dataset.id;

    document.querySelector('[name="nama_pelanggan"]').value = this.dataset.nama;
    document.querySelector('[name="nomor_telepon"]').value = this.dataset.telepon;
    document.querySelector('[name="tanggal_reservasi"]').value = this.dataset.tanggal;
    document.querySelector('[name="waktu_reservasi"]').value = this.dataset.waktu;
    document.querySelector('[name="nomor_meja"]').value = this.dataset.meja;
    document.querySelector('[name="jumlah_tamu"]').value = this.dataset.jumlah;

    document.getElementById('submit-btn').textContent = 'Update Reservasi';
  });
});

  function resetForm() {
    const form = document.getElementById('reservasi-form');
    form.reset();
    form.action = `{{ route('kasir.insertReservasi') }}`;
    document.getElementById('form-method').value = 'POST';
    document.getElementById('submit-btn').textContent = 'Simpan Reservasi';
  }
</script>
@endsection
