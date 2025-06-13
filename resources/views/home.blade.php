<!-- filepath: resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Agro Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-cyan-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-[#52C4D5] text-white shadow-md">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between py-4 px-6">
            <div class="flex items-center gap-2">
                <i class="fas fa-leaf text-2xl"></i>
                <span class="font-bold text-2xl">AgroStock</span>
            </div>
            <nav class="flex flex-wrap gap-2 mt-3 md:mt-0">
                <a href="{{ route('about') }}" class="navbar-btn px-4 py-2 rounded border border-white hover:bg-white hover:text-[#52C4D5] transition">About Us</a>
                <a href="{{ route('login') }}" class="navbar-btn px-4 py-2 rounded border border-white hover:bg-white hover:text-[#52C4D5] transition">Login</a>
                <a href="{{ route('register') }}" class="navbar-btn px-4 py-2 rounded border border-white hover:bg-white hover:text-[#52C4D5] transition">Sign Up</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col md:flex-row items-center justify-center container mx-auto px-4 py-10 gap-8">
        <div class="flex-1 flex flex-col justify-center items-start md:items-start space-y-6">
            <h1 class="text-3xl md:text-4xl font-bold text-[#52C4D5] leading-tight">
                Platform Terintegrasi untuk Pengelolaan Stok Barang yang Efisien dan Akurat
            </h1>
            <p class="text-gray-700 text-lg md:text-xl">
                Catat, pantau, dan kelola data stok dengan mudah. Agro Stock membantu mempercepat proses pemesanan barang,
                meminimalkan kesalahan, serta meningkatkan akurasi dan efisiensi operasional perusahaan Anda.
            </p>
            <a href="{{ route('register') }}" class="inline-block bg-[#52C4D5] hover:bg-[#3caec0] text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                Get Started
            </a>
        </div>
        <div class="flex-1 flex justify-center items-end">
            <img src="{{ asset('potoo.png') }}" alt="Foto" class="max-w-xs md:max-w-md w-full drop-shadow-xl rounded-xl">
        </div>
    </main>

    <!-- Footer (optional) -->
    <footer class="text-center text-gray-500 py-4">
        &copy; {{ date('Y') }} AgroStock. All rights reserved.
    </footer>
</body>
</html>