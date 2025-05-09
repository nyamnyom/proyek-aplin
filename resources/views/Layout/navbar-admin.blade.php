<nav class="navbar navbar-expand navbar-light bg-white p-3 mb-4">
    <div class="container-fluid">
        <form class="d-flex flex-grow-1 mx-4">
            <input class="form-control search-bar" type="search" placeholder="Cari pelanggan..." aria-label="Search">
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
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKAamFgOgNtmpuPBVncHVC-AJALeVJB0LyvQ&s" alt="Profile" class="profile-img">
                    <div>
                        <div class="small fw-bold">Alexander Brick</div>
                        <div class="text-muted small">Admin</div>
                    </div>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item logout" href="/">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>