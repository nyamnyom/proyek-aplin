<div class="col-md-2 px-0 sidebar">
    <div class="p-3 d-flex align-items-center">
        <div class="logo">WH</div>
        <span class="navbar-brand mb-0">Wei Hong</span>
    </div>
    <div class="p-2 pt-3">
        <h6 class="text-uppercase text-muted mb-3 ms-2 small">Main Menu</h6>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'dashboard' ? 'active' : '' ?>" href="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item mb-2"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'manajemen-menu' ? 'active' : '' ?>" href="manajemen-menu"><i class="bi bi-egg-fried"></i> Manajemen Menu</a></li>
            <li class="nav-item mb-2"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'riwayat-penjualan' ? 'active' : '' ?>" href="riwayat-penjualan"><i class="fas fa-list-alt"></i> Riwayat Penjualan</a></li>
            <li class="nav-item mb-2"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'manajemen-pegawai' ? 'active' : '' ?>" href="manajemen-pegawai"><i class="bi bi-people-fill"></i> Manajemen Pegawai</a></li>
            <li class="nav-item mb-2"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'daftar-event' ? 'active' : '' ?>" href="daftar-event"><i class="fas fa-calendar"></i> Daftar Event</a></li>
            <li class="nav-item mb-2"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'inventaris' ? 'active' : '' ?>" href="inventaris"><i class="bi bi-cart-fill"></i> Inventaris</a></li>
        </ul>
    </div>
</div>