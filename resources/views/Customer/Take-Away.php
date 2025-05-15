<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dine In - Restoran Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <!-- Header Row: Back - Weather - Checkout -->
        <div class="d-flex flex-column align-items-center mb-3">
            <div class="d-flex justify-content-between align-items-center w-100 mb-2">
                <a href="/" class="btn btn-outline-secondary">
                    &larr; Kembali
                </a>
                <div id="weather-widget" class="text-center flex-grow-1 mx-3"></div>
                <a href="/Checkout" class="btn btn-success">
                    <i class="fas fa-shopping-cart me-1"></i> Checkout
                </a>
            </div>
            <div id="recommendation-text" class="text-danger fw-semibold text-center"></div>
        </div>

        <!-- Welcome -->
        <h2 class="mb-4 fw-bold text-dark">Welcome, Order apa hari ini?</h2>

        <!-- Category Navigation -->
        <ul class="nav nav-pills category-nav mb-4" id="categoryNav">
    <li class="nav-item"><a class="nav-link active" href="#" data-category="all">Semua</a></li>
    <li class="nav-item"><a class="nav-link" href="#" data-category="Makanan">Makanan</a></li>
    <li class="nav-item"><a class="nav-link" href="#" data-category="Minuman">Minuman</a></li>
    <li class="nav-item"><a class="nav-link" href="#" data-category="best-seller">Terlaris</a></li> <!-- Kategori Terlaris -->
</ul>

        <!-- Menu Items -->
        <div class="row" id="menuContainer">
    @foreach($menus as $menu)
    <div class="col-md-4 mb-4 menu-item" 
     data-category="{{ $menu->category }}" 
     data-ordered="{{ $menu->total_ordered }}">
        <div class="card h-100 shadow-sm">
            <img src="{{ $menu->image_url }}" class="menu-img" alt="{{ $menu->name }}">
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter menu by category
     
document.addEventListener('DOMContentLoaded', function () {
    const categoryButtons = document.querySelectorAll('.category-nav [data-category]');
    const menuContainer = document.getElementById('menuContainer');
    const originalItems = Array.from(menuContainer.children); // backup asli

    categoryButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            // Atur tombol active
            categoryButtons.forEach(link => link.classList.remove('active'));
            this.classList.add('active');

            const category = this.getAttribute('data-category');

            // Kosongkan kontainer menu
            menuContainer.innerHTML = '';

            let filteredItems;

            if (category === 'all') {
                filteredItems = originalItems;
            } else if (category === 'best-seller') {
                // Urutkan semua berdasarkan total_ordered (descending)
                filteredItems = [...originalItems].sort((a, b) => {
                    const aOrdered = parseInt(a.dataset.ordered || '0');
                    const bOrdered = parseInt(b.dataset.ordered || '0');
                    return bOrdered - aOrdered;
                }).slice(0, 10);  // Batasi hanya 10 item teratas
            } else {
                // Filter berdasarkan kategori tertentu
                filteredItems = originalItems.filter(item => item.dataset.category === category);
            }

            // Tambahkan elemen yang sudah difilter/diurut kembali ke DOM
            filteredItems.forEach(item => {
                item.style.display = 'block';
                menuContainer.appendChild(item);
            });
        });
    });
});



        // Fetch Weather Info
        document.addEventListener("DOMContentLoaded", function () {
    fetch('/weather/Jakarta')
        .then(response => response.json())
        .then(data => {
            const temp = data.main.temp;
            const city = data.name;
            const desc = data.weather[0].description.toLowerCase();
            const icon = data.weather[0].icon;
            const weatherBox = `
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <img src="https://openweathermap.org/img/wn/${icon}@2x.png" alt="${desc}" style="width: 50px;">
                    <div>
                        <strong>${city}</strong> – ${desc}, ${temp}°C
                    </div>
                </div>
            `;
            document.getElementById('weather-widget').innerHTML = weatherBox;

            // Rekomendasi dinamis berdasarkan cuaca
            const recText = document.getElementById('recommendation-text');
            if (temp > 30) {
                recText.innerHTML = `Wah panas yah hari ini, Rekomendasi: <span class="text-dark">Mie Goreng</span> dan <span class="text-dark">minuman yang segar-segar</span> 🍹`;
            } else if (Math.round(temp) <= 28 || desc.includes('rain')) {
                recText.innerHTML = `Wah. cuaca begini enaknya yang hangat-hangat ya, kami rekomendasikan <span class="text-dark">Mie Kuah</span> dan <span class="text-dark">minuman hangat</span> ☕`;
            } else {
                recText.innerHTML = `Selamat menikmati hari ini! Pilih menu favoritmu ya 😊`;
            }
        })
        .catch(error => {
            console.error("Gagal mengambil data cuaca:", error);
        });
});

    </script>
</body>
</html>
