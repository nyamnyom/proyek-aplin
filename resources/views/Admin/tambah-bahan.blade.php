@extends('Layout.layout-admin')

@section('title', 'Edit Bahan')

@section('content')
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold">Data Master Bahan</h4>
      <small class="text-muted">Main Menu / Inventaris Bahan / <span class="text-danger">Tambah Bahan Baru</span></small>
    </div>
    <div>
      <a href="inventaris" class="btn btn-outline-danger me-2">Cancel</a>
      <a href="inventaris" id="submitBtn" class="btn btn-danger text-light disabled" onclick="return false;">Tambah Bahan</a>
    </div>
  </div>

  <!-- Form -->
  <div class="row">
    <!-- Kiri -->
    <div class="col-md-8">
      <div class="card p-4 mb-4 shadow-sm rounded-4">
        <h5 class="mb-4 fw-semibold">Bahan #B099</h5>
        <div class="mb-3">
          <label class="form-label">Nama Bahan</label>
          <input type="text" class="form-control" id="namaBahan" placeholder="Masukkan nama menu...">
        </div>
        <div class="row g-3">
          <div class="col-md-8">
            <label class="form-label">Minimal Stok Bahan</label>
            <input type="number" class="form-control" id="stokBahan" min=10 placeholder="Masukkan minimal stok bahan..."> 
          </div>
          <div class="col-md-4">
            <label class="form-label">Satuan</label>
            <select class="form-select" id="satuanBahan">
              <option selected disabled>Pilih satuan</option>
              <option>kg</option>
              <option>butir</option>
              <option>liter</option>
              <option>pak</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Kanan -->
    <div class="col-md-4">
      <div class="card p-4 shadow-sm rounded-4">
        <div class="mb-3">
          <label class="form-label">Harga Bahan</label>
          <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" class="form-control" id="hargaBahan" min=1000 placeholder="Masukkan harga bahan...">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori Bahan</label>
          <select class="form-select" id="kategoriBahan">
            <option selected disabled>Pilih kategori</option>
            <option>Daging Mentah</option>
            <option>Organ Dalam Daging</option>
            <option>Lemak & Lainnya</option>
            <option>Bahan Pokok</option>
            <option>Sayuran</option>
            <option>Karbodirat</option>
            <option>Buah</option>
            <option>Daun Teh</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Status Bahan</label>
          <select class="form-select" id="statusBahan">
            <option selected disabled>Pilih status</option>
            <option>Tersedia</option>
            <option>Kurang</option>
            <option>Habis</option>
          </select>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    const fields = [
      'namaBahan',
      'stokBahan',
      'satuanBahan',
      'hargaBahan',
      'kategoriBahan',
      'statusBahan'
    ];

    const submitBtn = document.getElementById('submitBtn');

    function validateForm() {
      let isValid = true;

      fields.forEach(id => {
        const field = document.getElementById(id);
        if (!field.value || field.value.includes("Pilih")) {
          isValid = false;
        }
      });

      if (isValid) {
        submitBtn.classList.remove('disabled');
        submitBtn.onclick = () => true; // allow navigation
      } else {
        submitBtn.classList.add('disabled');
        submitBtn.onclick = () => false; // prevent navigation
      }
    }

    fields.forEach(id => {
      const field = document.getElementById(id);
      field.addEventListener('input', validateForm);
      field.addEventListener('change', validateForm);
    });

    validateForm(); // initial check
  </script>
@endsection