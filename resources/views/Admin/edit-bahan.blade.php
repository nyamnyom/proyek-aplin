@extends('Layout.layout-admin')

@section('title', 'Edit Bahan')

@section('content')
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold">Data Master Bahan</h4>
      <small class="text-muted">Main Menu / Inventaris Bahan / <span class="text-danger">Edit Bahan</span></small>
    </div>
    <div>
      <a href="inventaris" class="btn btn-outline-danger me-2">Cancel</a>
      <a href="inventaris" id="editBtn" class="btn btn-danger text-light">Edit Bahan</a>
    </div>
  </div>

  <!-- Form -->
  <div class="row">
    <!-- Kiri -->
    <div class="col-md-8">
      <div class="card p-4 mb-4 shadow-sm rounded-4">
        <h5 class="mb-4 fw-semibold">Bahan #B001</h5>
        <div class="mb-3">
          <label class="form-label">Nama Bahan</label>
          <input type="text" class="form-control" id="namaBahan" value="Daging Babi">
        </div>
        <div class="row g-3">
          <div class="col-md-8">
            <label class="form-label">Minimal Stok Bahan</label>
            <input type="number" class="form-control" id="stokBahan" value="3">
          </div>
          <div class="col-md-4">
            <label class="form-label">Satuan</label>
            <select class="form-select" id="satuanBahan">
              <option disabled>Pilih satuan</option>
              <option selected>kg</option>
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
            <input type="number" class="form-control" id="hargaBahan" value="80000">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori Bahan</label>
          <select class="form-select" id="kategoriBahan">
            <option disabled>Pilih kategori</option>
            <option selected>Daging Mentah</option>
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
            <option disabled>Pilih status</option>
            <option selected>Tersedia</option>
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

    const editBtn = document.getElementById('editBtn');

    function validateEditForm() {
      let isValid = true;

      fields.forEach(id => {
        const field = document.getElementById(id);
        if (!field.value || field.value.includes("Pilih")) {
          isValid = false;
        }
      });

      editBtn.classList.toggle('disabled', !isValid);
      editBtn.onclick = isValid ? () => true : () => false;
    }

    fields.forEach(id => {
      const field = document.getElementById(id);
      field.addEventListener('input', validateEditForm);
      field.addEventListener('change', validateEditForm);
    });

    validateEditForm(); // Initial run
  </script>
@endsection

