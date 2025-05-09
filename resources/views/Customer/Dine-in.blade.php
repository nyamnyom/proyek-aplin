<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dine In - Restoran Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B0000;
            --secondary-color: #D32F2F;
            --text-light: #FFFFFF;
            --text-dark: #333333;
            --bg-gray: #F5F5F5;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-gray);
            margin: 0;
            padding: 0;
        }

        .menu-img {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .category-nav .nav-link.active {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background-color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: darkred;
            border-color: darkred;
        }

        .btn-outline-secondary {
            color: var(--text-dark);
            border-color: var(--text-dark);
        }

        .btn-outline-secondary:hover {
            background-color: var(--text-dark);
            color: var(--text-light);
        }

        .fw-bold {
            color: var(--primary-color);
        }

        .nav-pills .nav-link {
            color: var(--primary-color);
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
        <h2 class="mb-4 fw-bold text-dark">Welcome, Order apa hari ini?</h2>

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
