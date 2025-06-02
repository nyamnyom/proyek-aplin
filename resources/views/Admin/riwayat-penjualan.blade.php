@extends('Layout.layout-admin')

@section('title', 'Riwayat Penjualan')

@section('content')
  <h2 class="fw-bold">Riwayat Penjualan</h2>
  <div class="row mt-4">
    <!-- List Penjualan -->
    <div class="col-md-7">
      <ul class="nav nav-tabs mb-3" id="salesTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="cashier-tab" data-bs-toggle="tab" href="#cashier-pane" role="tab">Cashier</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="selfService-tab" data-bs-toggle="tab" href="#selfService-pane" role="tab">Self Service</a>
        </li>
      </ul>

      <div class="tab-content" id="salesTabContent">
        <div class="tab-pane fade show active" id="cashier-pane" role="tabpanel">
          <div class="list-group overflow-auto border" style="max-height: 66vh;" id="cashierList"></div>
        </div>
        <div class="tab-pane fade" id="selfService-pane" role="tabpanel">
          <div class="list-group overflow-auto border" style="max-height: 66vh;" id="selfServiceList"></div>
        </div>
      </div>

      <div class="list-group overflow-auto border" style="max-height: 66vh;" id="salesList">
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
          total: h.total,
          payment_method: h.payment_method
        };
      });

      return combined;
    }

    function printReceipt(trx, ts) {
      console.log(ts)
      const total = trx.reduce((sum, item) => sum + item.subtotal, 0);
      const totalQty = trx.reduce((sum, item) => sum + item.qty, 0);

      const itemsHtml = trx.map(item => `
        <p>${item.item_name}<br>
        <span>${item.qty} × ${item.price.toLocaleString('id-ID')} = Rp ${(item.qty * item.price).toLocaleString('id-ID')}</span></p>
      `).join("");
        
      const htmlContent = `
        <html>
          <head>
            <title>Nota Pembelian</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
              body { font-family: monospace; background: #fff; padding: 20px; }
              .receipt-box { border: 1px solid #000; padding: 20px; max-width: 400px; margin: auto; }
              .receipt-header { text-align: center; margin-bottom: 15px; }
              .receipt-line { border-top: 1px dashed #000; margin: 10px 0; }
              .total-box { border-top: 2px solid #000; padding-top: 10px; }
              .text-center { text-align: center; }
            </style>
          </head>
          <body>
            <div class="receipt-box">
              <div class="receipt-header">
                <h2>WH</h2>
                <p>Jl. Raya Wonorejo Permai No.rk 3, Wonorejo,<br> Kec. Rungkut, Surabaya, Jawa Timur 60296<br>
                No. Telp 0813-3683-3882</p>
              </div>
              <div class="receipt-line"></div>
              <p><strong>Tanggal:</strong> ${ts.created_at}<br>
                <strong>Kasir:</strong> ${ts.nama ?? '-'}<br>
                <strong>Metode Bayar:</strong> ${ts.payment_method}
              </p>
              <div class="receipt-line"></div>
              ${itemsHtml}
              <div class="receipt-line"></div>
              <p><strong>Total QTY:</strong> ${totalQty}</p>
              <div class="total-box">
                <p class="fw-bold">Total: Rp ${total.toLocaleString('id-ID')}</p>
                <p>Bayar: Rp ${total.toLocaleString('id-ID')}</p>
                <p>Kembali: Rp 0</p>
              </div>
              <div class="text-center">
                <p>Terimakasih Atas Kunjungan Anda</p>
              </div>
            </div>
            <script>
              window.onload = () => window.print();
            <\/script>
          </body>
        </html>
      `;
        
      const receiptWindow = window.open("", "_blank", "width=500,height=700");
      receiptWindow.document.open();
      receiptWindow.document.write(htmlContent);
      receiptWindow.document.close();
    }


    function loadHistory() {
      fetch('/transaction')
        .then(res => res.json())
        .then(data => {
          const htrans = data.htrans;
          const user = data.user;

          transaction = combineTransactionWithUser(htrans, user);
          renderCashier(transaction);
          renderSelfService(transaction);
        })
        .catch(err => console.error(err));
    }

    loadHistory();

    function renderCashier(data) {
      const list = document.getElementById('cashierList');
      list.innerHTML = '';
      data.forEach(t => {
        if (t.nama != '') {
          list.innerHTML += `
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showPesanan('${t.id}')">
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

    function renderSelfService(data) {
      const list = document.getElementById('selfServiceList');
      list.innerHTML = '';
      data.forEach(t => {
        if (t.nama == '') {
          list.innerHTML += `
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showPesanan('${t.id}')">
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


    function showPesanan(id){
      fetch('/dtrans')
      .then(res => {
        if (!res.ok) throw new Error('Fetch error');
        return res.json();
      })
      .then(data => {
        console.log(data)
        showSaleDetail(id,data);

      })
      .catch(err => console.error(err));
    }


    function showSaleDetail(id, data) { 
      const trx = data
        .filter(t => t.htrans_id == id)
        .sort((a, b) => b.subtotal - a.subtotal);
      const ts = transaction.find(t => t.id == id);
      console.log(trx)
      if (!trx) return;
      
      document.getElementById('trxDetail').innerText = ts.nama ? `ID : ${ts.id}\n\nKasir : ${ts.nama}` : `ID : ${ts.id}`;
      document.getElementById('printButton').disabled = false;
      document.getElementById('printButton').onclick = () => printReceipt(trx, ts);
    
      const tbody = document.getElementById('detailTable');
      tbody.innerHTML = '';
      trx.forEach(t => {
        tbody.innerHTML += `<tr><td>${t.item_name}</td><td>${t.qty}</td></tr>`;
      });
    }

    renderCashier(transaction);
  </script>
@endsection
