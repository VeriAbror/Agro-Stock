<!-- filepath: resources/views/about.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agro Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-cyan-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="bg-[#52C4D5] text-white shadow-md fixed w-full z-10">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between py-4 px-6">
            <div class="flex items-center gap-2">
                <i class="fas fa-leaf text-2xl"></i>
                <span class="font-bold text-2xl">Agro Stock</span>
            </div>
            <nav class="flex flex-wrap gap-2 mt-3 md:mt-0">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded hover:bg-white hover:text-[#52C4D5] transition">Home</a>
                <a href="{{ route('login') }}" class="navbar-btn px-4 py-2 rounded border border-white hover:bg-white hover:text-[#52C4D5] transition">Login</a>
                <a href="{{ route('register') }}" class="navbar-btn px-4 py-2 rounded border border-white hover:bg-white hover:text-[#52C4D5] transition">Sign Up</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col items-center justify-center container mx-auto px-4 py-10 mt-24">
        <div class="max-w-3xl w-full bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h1 class="text-3xl font-bold text-[#52C4D5] mb-4 text-center">Tentang Perusahaan</h1>
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="flex-1 flex justify-center">
                    <img src="gedunk.jpg" alt="Gambar Perusahaan" class="rounded-xl shadow-md max-w-xs md:max-w-sm w-full">
                </div>
                <div class="flex-1">
                    <p class="text-gray-700 text-lg leading-relaxed">
                        PT Manajemen Stok Indonesia adalah perusahaan terkemuka yang berfokus pada solusi manajemen stok dan inventaris untuk berbagai industri. Kami menyediakan layanan lengkap yang mencakup pengelolaan stok yang efisien, pelacakan inventaris secara real-time, dan optimisasi rantai pasokan untuk membantu perusahaan mengurangi biaya operasional dan meningkatkan kinerja bisnis mereka.<br><br>
                        Sebagai perusahaan yang berorientasi pada teknologi, kami selalu berusaha untuk menawarkan solusi inovatif yang didukung oleh sistem digital terbaru. Kami memahami bahwa pengelolaan stok yang tepat sangat penting untuk menjaga kelancaran operasional dan meminimalkan kerugian yang disebabkan oleh stok yang tidak terkelola dengan baik.<br><br>
                        Kami memiliki tim profesional yang berpengalaman dan berdedikasi tinggi dalam merancang dan mengimplementasikan sistem manajemen stok yang sesuai dengan kebutuhan spesifik masing-masing klien. Dengan pengalaman lebih dari 15 tahun dalam industri ini, PT Manajemen Stok Indonesia berkomitmen untuk memberikan solusi yang dapat diandalkan dan memberikan nilai tambah yang nyata bagi setiap pelanggan.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center text-center">
                <i class="fas fa-file-alt text-4xl text-[#52C4D5] mb-4"></i>
                <h3 class="text-xl font-semibold text-[#52C4D5] mb-2">Visi</h3>
                <p class="text-gray-600">
                    Menjadi pemimpin dalam solusi manajemen stok yang inovatif dan terpercaya, dengan fokus pada peningkatan efisiensi operasional dan produktivitas di berbagai sektor industri. Kami berkomitmen untuk mendigitalisasi pengelolaan stok, mengurangi pemborosan, dan meningkatkan daya saing perusahaan di Indonesia dengan solusi yang terintegrasi dan berbasis teknologi terkini.
                </p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center text-center">
                <i class="fas fa-calendar-alt text-4xl text-[#52C4D5] mb-4"></i>
                <h3 class="text-xl font-semibold text-[#52C4D5] mb-2">Misi</h3>
                <ul class="text-gray-600 text-left list-disc list-inside">
                    <li>Menyediakan sistem manajemen stok yang efisien dan akurat yang dapat membantu bisnis dalam mengelola persediaan secara lebih baik.</li>
                    <li>Membantu perusahaan mengurangi pemborosan dan biaya operasional yang terkait dengan pengelolaan stok.</li>
                    <li>Mengembangkan dan menerapkan teknologi terbaru untuk memastikan kelancaran dan transparansi dalam setiap proses pengelolaan stok.</li>
                </ul>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center text-center">
                <i class="fas fa-user text-4xl text-[#52C4D5] mb-4"></i>
                <h3 class="text-xl font-semibold text-[#52C4D5] mb-2">Kontak</h3>
                <p class="text-gray-600">
                    Email: email@gmail.com<br>
                    Telepon: +62 88888888888<br>
                    Website: www.manajemenstok.co.id<br>
                    Alamat: Jl. Malang
                </p>
            </div>
        </div>
    </main>

    <footer class="text-center text-gray-500 py-4 mt-4">
        &copy; 2025 Agro Stock. All Rights Reserved.
    </footer>
</body>
</html>