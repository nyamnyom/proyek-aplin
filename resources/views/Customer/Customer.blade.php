<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .option-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .option-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mb-5">
                <div class="welcome-card p-5">
                    <h1 class="display-4 fw-bold text-primary">
                        <i class="fas fa-utensils me-2"></i>
                        SELAMAT DATANG DI RESTORANT KAMI
                    </h1>
                    <p class="lead mt-3">Silahkan pilih jenis pelayanan</p>
                </div>
            </div>

            <div class="col-md-10">
                <div class="row g-4">
                    <!-- Dine In Option -->
                    <div class="col-md-6">
                        <div class="option-card card h-100 text-center p-4 bg-white border-0 rounded-3">
                            <div class="card-body">
                                <i class="fas fa-chair fa-5x text-success mb-4"></i>
                                <h3 class="card-title">Dine In</h3>
                                <p class="card-text">Nikmati makanan langsung di tempat kami</p>
                                <a href="/customer/dine-in" class="btn btn-success btn-lg mt-3">
                                    Pilih <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Take Away Option -->
                    <div class="col-md-6">
                        <div class="option-card card h-100 text-center p-4 bg-white border-0 rounded-3">
                            <div class="card-body">
                                <i class="fas fa-shopping-bag fa-5x text-warning mb-4"></i>
                                <h3 class="card-title">Take Away</h3>
                                <p class="card-text">Bawa pulang makanan favorit Anda</p>
                                <a href="/customer/take-away" class="btn btn-warning btn-lg mt-3">
                                    Pilih <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>