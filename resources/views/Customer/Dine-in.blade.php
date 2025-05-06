<!-- dine-in.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dine In - Restoran Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-img {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .category-nav .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <!-- Back Button -->
        <div class="mb-3">
            <a href="/" class="btn btn-outline-secondary">
                &larr; Kembali
            </a>
            <a href="/Checkout" class="btn btn-success">
                <i class="fas fa-shopping-cart me-1"></i> Checkout
            </a>
        </div>

        <!-- Welcome -->
        <h2 class="mb-4 fw-bold">Welcome, Order apa hari ini?</h2>

        <!-- Category Navigation -->
        <ul class="nav nav-pills category-nav mb-4" id="categoryNav">
            <li class="nav-item"><a class="nav-link active" href="#" data-category="all">Semua</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-category="food">Makanan</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-category="drink">Minuman</a></li>
        </ul>

        <!-- Menu Items -->
        <div class="row" id="menuContainer">
            @foreach($menus as $menu)
<div class="col-md-4 mb-4 menu-item" data-category="{{ $menu->category }}">
    <div class="card h-100 shadow-sm">
        <img src="{{ $menu->image_url}}" class="menu-img" alt="{{ $menu->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $menu->name }}</h5>
            <p class="card-text text-muted">{{ $menu->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                <!-- Tombol tambah ke cart -->
                <form action="/add-to-cart/{{ $menu->id }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-cart-plus"></i> Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter menu by category
        document.querySelectorAll('.category-nav [data-category]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                this.classList.add('active');
                const cat = this.getAttribute('data-category');
                document.querySelectorAll('.menu-item').forEach(item => {
                    item.style.display = (cat === 'all' || item.dataset.category === cat) ? 'block' : 'none';
                });
            });
        });
    </script>
</body>
</html>
