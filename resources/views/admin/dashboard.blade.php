<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Tambahkan style custom untuk memastikan konten utama tidak tertutup sidebar */
        .main-content {
            margin-left: 16rem; /* Sesuaikan dengan lebar sidebar (64 = 16rem) */
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <div class="flex min-h-screen">

        <!-- Sidebar - Ditambahkan fixed, h-full, dan z-10 -->
        <aside class="bg-[#52C4D5] w-64 flex-shrink-0 shadow-md flex flex-col justify-between fixed h-full z-10">
            <div>
                <div class="p-6 text-white font-bold text-2xl text-center">AgroStock</div>
                <nav class="mt-4 flex flex-col gap-2">
                    <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium bg-white/20 text-white">
                        <i class="fas fa-home w-5 text-center"></i> Dashboard
                    </a>
                    <a href="/master" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white font-medium hover:bg-white/20 transition">
                        <i class="fas fa-boxes w-5 text-center"></i> Master Stock
                    </a>
                    <a href="/mutasi" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white font-medium hover:bg-white/20 transition">
                        <i class="fas fa-exchange-alt w-5 text-center"></i> Mutasi Stock
                    </a>
                    <a href="/card" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white font-medium hover:bg-white/20 transition">
                        <i class="fas fa-id-card w-5 text-center"></i> Card Stock
                    </a>
                    <a href="/reports" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white font-medium hover:bg-white/20 transition">
                        <i class="fas fa-shopping-cart w-5 text-center"></i> Pesanan User
                    </a>
                </nav>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mb-6 px-4">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-white font-medium hover:bg-white/20 transition">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i> Logout
                </button>
            </form>
        </aside>

        <!-- Main Content - Ditambahkan class main-content dan ml-64 -->
        <main class="flex-1 p-6 main-content ml-64">
            <!-- Header -->
            <div class="bg-[#52C4D5] rounded-2xl p-8 flex flex-col md:flex-row items-center justify-between mb-8 shadow">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        Hi, Selamat datang {{ auth()->user()->name }}!
                    </h1>
                    <p class="text-white/90">Kelola seluruh data stok dan laporan di sistem ini.</p>
                </div>
                <a href="/profile" class="relative group">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin" class="w-24 h-24 object-contain rounded-xl mt-6 md:mt-0 transition-transform duration-200 group-hover:scale-105" />
                    <span class="absolute inset-0 flex items-center justify-center rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-white font-semibold text-lg">Profile
                    </span>
                </a>
            </div>

            <!-- Section -->
            <section>
                <h2 class="text-xl font-semibold text-[#52C4D5] mb-6">Popular</h2>
                {{-- Livewire komponen akan menampilkan grid penuh --}}
                @livewire('popular-stock')
            </section>
        </main>
    </div>
</body>
</html>