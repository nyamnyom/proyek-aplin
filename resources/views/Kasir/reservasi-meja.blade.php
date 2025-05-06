<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wei Hong Restaurant - Sistem Kasir</title>
  @include('style.kasirStyle')
</head>
<body>
  <div class="container-fluid p-0">
    <div class="row g-0">
      <!-- Sidebar -->
      <div class="col-md-2 px-0 sidebar">
          <div class="p-3 d-flex align-items-center">
              <div class="logo">WH</div>
              <span class="navbar-brand">Wei Hong</span>
          </div>
          <div class="p-3">
              <h6 class="text-uppercase text-muted mb-3 small">Main Menu</h6>
              <ul class="nav flex-column">
                  <li class="nav-item" >
                      <a class="nav-link" href="kasir-main">
                          <i class="fas fa-plus-circle me-2"></i> Tambah Pesanan
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active" href="reservasi-meja">
                          <i class="fas fa-bookmark me-2"></i> Reservasi Meja
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="daftar-pesanan">
                          <i class="fas fa-clipboard-list me-2"></i> Daftar Pesanan
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">
                          <i class="fas fa-percentage me-2"></i> Promosi dan Diskon
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">
                          <i class="fas fa-cog me-2"></i> Pengaturan Sistem
                      </a>
                  </li>
              </ul>
          </div>
      </div>
      
      <!-- Main Content -->
      <div class="col-md-10 main-content">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand navbar-light bg-white p-3">
            <div class="container-fluid">
                <form class="d-flex flex-grow-1 mx-4">
                    <input class="form-control search-bar" type="search" placeholder="Cari menu, pelanggan, dll..." aria-label="Search">
                </form>
                <div class="d-flex align-items-center">
                    <div class="notification-icon mx-3">
                        <i class="fas fa-bell fa-lg text-muted"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="notification-icon mx-3">
                        <i class="fas fa-comment fa-lg text-muted"></i>
                        <span class="notification-badge">2</span>
                    </div>
                    <div class="notification-icon mx-3">
                        <i class="fas fa-heart fa-lg text-muted"></i>
                        <span class="notification-badge">1</span>
                    </div>
                    <div class="user-profile ms-4 dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <img src="https://img.freepik.com/premium-photo/fun-unique-cartoon-profile-picture-that-represents-your-style-personality_1283595-14223.jpg" alt="Profile" class="profile-img">
                            <div class="ms-2">
                                <div class="small fw-bold">Alexander Brick</div>
                                <div class="text-muted small">Kasir</div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item logout" href="../login.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Content Area -->
        <div class="content-area">
          <div class="content-header">
            <div>
              <h4>Reservasi Meja</h4>
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Main Menu</a></li>
                  <li class="breadcrumb-item active">Reservasi Meja</li>
                </ol>
              </nav>
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
                  <label class="form-label">Reservasi #567</label>
                  <div class="d-flex gap-2">
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      <input type="text" class="form-control" value="Senin 02/12" readonly>
                    </div>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-clock"></i></span>
                      <input type="text" class="form-control" value="15:00" readonly>
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
                
                <div class="row align-items-center mt-4">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Tanggal Reservasi</label>
                      <div class="calendar">
                        <div class="calendar-header">
                          <span>Maret 2024</span>
                          <div>
                            <button class="btn btn-sm btn-outline-secondary me-1">&lt;</button>
                            <button class="btn btn-sm btn-outline-secondary">&gt;</button>
                          </div>
                        </div>
                        <div class="calendar-days mb-2">
                          <div>S</div>
                          <div>M</div>
                          <div>T</div>
                          <div>W</div>
                          <div>T</div>
                          <div>F</div>
                          <div>S</div>
                        </div>
                        <div class="calendar-days">
                          <div></div>
                          <div></div>
                          <div></div>
                          <div></div>
                          <div>1</div>
                          <div>2</div>
                          <div>3</div>
                          <div>4</div>
                          <div>5</div>
                          <div>6</div>
                          <div>7</div>
                          <div>8</div>
                          <div>9</div>
                          <div>10</div>
                          <div>11</div>
                          <div class="text-danger">12</div>
                          <div>13</div>
                          <div>14</div>
                          <div>15</div>
                          <div>16</div>
                          <div>17</div>
                          <div>18</div>
                          <div>19</div>
                          <div>20</div>
                          <div class="selected">21</div>
                          <div>22</div>
                          <div>23</div>
                          <div>24</div>
                          <div>25</div>
                          <div>26</div>
                          <div>27</div>
                          <div>28</div>
                          <div>29</div>
                          <div>30</div>
                          <div>31</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Waktu Reservasi</label>
                      <div class="time-selector">
                        <div class="clock">
                          <div class="clock-hand"></div>
                          <div class="clock-mark">
                            <div style="top: 10px; left: 70px;">12</div>
                            <div style="top: 25px; right: 25px;">1</div>
                            <div style="top: 70px; right: 10px;">2</div>
                            <div style="bottom: 70px; right: 10px;">3</div>
                            <div style="bottom: 25px; right: 25px;">4</div>
                            <div style="bottom: 10px; left: 70px;">5</div>
                            <div style="bottom: 25px; left: 25px;">6</div>
                            <div style="bottom: 70px; left: 10px;">7</div>
                            <div style="top: 70px; left: 10px;">8</div>
                            <div style="top: 45px; left: 20px;">9</div>
                            <div style="top: 20px; left: 45px;">10</div>
                            <div style="top: 10px; right: 45px;">11</div>
                          </div>
                        </div>
                        <div class="text-center mt-3">
                          <div class="input-group justify-content-center">
                            <input type="text" class="form-control text-center" style="max-width: 70px;" value="00">
                            <span class="input-group-text">:</span>
                            <input type="text" class="form-control text-center" style="max-width: 70px;" value="00">
                            <div class="time-toggle ms-2">
                              <button class="active">AM</button>
                              <button>PM</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Nomor Meja</label>
                      <select class="form-select mb-3">
                        <option selected>Jumlah 1</option>
                        <option>Jumlah 2</option>
                        <option>Jumlah 3</option>
                        <option>Jumlah 4</option>
                      </select>
                      
                      <div class="table-options">
                        <div class="table-item reserved">
                          <div class="table-number">T1</div>
                          <div class="table-label">Tersedia</div>
                        </div>
                        <div class="table-item available">
                          <div class="table-number">T4</div>
                          <div class="table-label">Tersedia</div>
                        </div>
                        <div class="table-item available">
                          <div class="table-number">T2</div>
                          <div class="table-label">Tersedia</div>
                        </div>
                        <div class="table-item available">
                          <div class="table-number">T5</div>
                          <div class="table-label">Tersedia</div>
                        </div>
                        <div class="table-item reserved">
                          <div class="table-number">T3</div>
                          <div class="table-label">Tersedia</div>
                        </div>
                        <div class="table-item available">
                          <div class="table-number">T6</div>
                          <div class="table-label">Tersedia</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
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
</body>
</html>
