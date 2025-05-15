@extends('Layout.layout-admin')

@section('title', 'Riwayat Penjualan')

@section('content')
  <h2 class="fw-bold">Riwayat Penjualan</h2>
  <div class="row mt-4">
    <!-- List Penjualan -->
    <div class="col-md-7">
      <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
          <a class="nav-link active" href="#" id="cash" onclick="setActiveAndRender(event, renderCash, transaction)">Cash</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="qris" onclick="setActiveAndRender(event, renderQris, transaction)">Qris</a>        
        </li>
      </ul>

      <div class="list-group" id="salesList">
        <!-- List akan diisi oleh JavaScript -->
      </div>
    </div>

    <!-- Detail Penjualan -->
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="fw-bold" id="trxDetail">Pilih transaksi</h6>
            <span class="badge bg-danger" id="trxDate"></span>
          </div>

          <table class="table mt-3">
            <thead>
              <tr>
                <th>Menu</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody id="detailTable">
              <tr><td colspan="2" class="text-muted">Belum ada transaksi dipilih</td></tr>
            </tbody>
          </table>

          <button class="btn btn-success w-100" id="printButton" disabled>
            <i class="fas fa-print"></i> Print Nota
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
let transaction = []
    function setActiveAndRender(event, renderFunc, data) {
      event.preventDefault();

      // Hapus class active dari semua nav-link
      document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));

      // Tambahkan class active ke yang diklik
      event.currentTarget.classList.add('active');

      // Panggil fungsi render dengan data
      renderFunc(data);
    }

    function combineTransactionWithUser(htransData, userData) {
      const combined = htransData.map(h => {
        const user = userData.find(u => u.id === h.kasir_id);
        return {
          id: h.id,
          nama: user ? user.nama : '',
          created_at: h.created_at,
          total: h.total
        };
      });

      return combined;
    }

    function loadHistory() {
      fetch('/transaction')
        .then(res => {
          if (!res.ok) throw new Error('Fetch error');
          return res.json();
        })
        .then(data => {
          const htrans = data.htrans;
          const user = data.user;

          transaction = combineTransactionWithUser(htrans, user);
          renderCash(transaction);
          console.log(combineTransactionWithUser(htrans, user))
        })
        .catch(err => console.error(err));
    }

    loadHistory();

    function renderCash(data) {
      const list = document.getElementById('salesList');
      list.innerHTML = '';
      data.forEach(t => {
        if (t.nama != ''){
          list.innerHTML += `
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSaleDetail('${t.id}')">
              <div>
                <strong>${t.id}</strong><br />
                <small>Nama Kasir: ${t.nama}</small>
              </div>
              <div class="text-end">
                <span class="badge bg-danger">${new Date(t.created_at).toISOString().split('T')[0]}</span><br />
                <strong>Rp ${t.total.toLocaleString('id-ID')}</strong>
              </div>
            </a>
          `;
        }
      });
    }
    
    function renderQris(data) {
      const list = document.getElementById('salesList');
      list.innerHTML = '';
      data.forEach(t => {
        if (t.nama == ''){
          list.innerHTML += `
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSaleDetail('${t.id}')">
              <div>
                <strong>${t.id}</strong><br />
              </div>
              <div class="text-end">
                <span class="badge bg-danger">${new Date(t.created_at).toISOString().split('T')[0]}</span><br />
                <strong>Rp ${t.total.toLocaleString('id-ID')}</strong>
              </div>
            </a>
          `;
        }
      });
    }

    function showSaleDetail(id) { //blumm
      const trx = transaction.find(t => t.id == id);
      if (!trx) return;
    
      document.getElementById('trxDetail').innerText = `${trx.id} | ${trx.nama}`;
      document.getElementById('printButton').disabled = false;
    
      const tbody = document.getElementById('detailTable');
      tbody.innerHTML = '';
      tbody.innerHTML += `<tr><td>${trx.menu}</td><td>${trx.total}</td></tr>`;

    }

    renderCash(transaction);
  </script>
@endsection
