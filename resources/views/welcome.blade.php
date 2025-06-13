<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <style>
            body {
                background-color: #00d9ff;
                color: #fff;
                font-family: Arial, sans-serif;
            }
            .hero-section {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 50px;
                min-height: 100vh;
            }
            .hero-text {
                max-width: 50%;
            }
            .hero-text h1 {
                font-size: 2.5rem;
                font-weight: bold;
                color: #1a1a1a;
            }
            .hero-text p {
                font-size: 1.2rem;
                color: #333;
            }
            .hero-text .btn {
                background-color: #5a9;
                color: #fff;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
            }
            .hero-text .btn:hover {
                background-color: #4a8;
            }
            .hero-image img {
                max-width: 100%;
                height: auto;
                border-radius: 10px;
            }
        </style>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">Agro Stock</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="#">Home</a>
                        <a class="nav-link" href="#">About Us</a>
                        <a class="nav-link btn btn-outline-primary me-2" href="{{ route('login') }}">Login</a>
                        <a class="nav-link btn btn-primary text-white" href="{{ route('register') }}">Sign Up</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="hero-section container">
            <div class="hero-text">
                <h1 class="mb-4">Platform Terintegrasi untuk Pengelolaan Stok Barang yang Efisien dan Akurat</h1>
                <p>Catat, pantau, dan kelola data stok dengan mudah. Agro Stock membantu mempercepat proses pemesanan barang, meminimalkan kesalahan, serta meningkatkan akurasi dan efisiensi operasional perusahaan Anda.</p>
                <a href="#" class="btn">Get Started</a>
            </div>
            <div class="hero-image">
                <img src="https://via.placeholder.com/400x500" alt="Hero Image">
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center py-3">
            <p>&copy; 2025 Agro Stock. All rights reserved.</p>
        </footer>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>