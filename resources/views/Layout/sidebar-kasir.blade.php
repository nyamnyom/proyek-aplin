<div class="col-md-2 px-0 sidebar">
    <div class="p-3 d-flex align-items-center">
        <div class="logo">WH</div>
        <span class="navbar-brand">Wei Hong</span>
    </div>
    <div class="p-3">
        <h6 class="text-uppercase text-muted mb-3 small">Main Menu</h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'kasir-main' ? 'active' : '' ?>" href="kasir-main">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'reservasi-meja' ? 'active' : '' ?>" href="reservasi-meja">
                    <i class="fas fa-bookmark me-2"></i> Reservasi Meja
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'daftar-pesanan' ? 'active' : '' ?>" href="daftar-pesanan">
                    <i class="fas fa-clipboard-list me-2"></i> Daftar Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'promosi-diskon' ? 'active' : '' ?>" href="">
                    <i class="fas fa-percentage me-2"></i> Promosi dan Diskon
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'pengaturan-sistem' ? 'active' : '' ?>" href="">
                    <i class="fas fa-cog me-2"></i> Pengaturan Sistem
                </a>
            </li>
        </ul>
    </div>
</div>
