<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @livewireStyles
    <style>
        .main-content {
            margin-left: 16rem; /* Same as w-64 */
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

        <!-- Fixed Sidebar -->
        <aside class="bg-[#52C4D5] w-64 flex-shrink-0 shadow-md flex flex-col justify-between fixed h-full z-10">
            <div>
                <div class="p-6 text-white font-bold text-2xl text-center">AgroStock</div>
                <nav class="mt-4 flex flex-col gap-2">
                    <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-white hover:bg-white/20 transition">
                        <i class="fas fa-home w-5 text-center"></i> Dashboard
                    </a>
                    <a href="/master" class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-white hover:bg-white/20 transition">
                        <i class="fas fa-boxes w-5 text-center"></i> Master Stock
                    </a>
                    <a href="/mutasi" class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-white hover:bg-white/20 transition">
                        <i class="fas fa-exchange-alt w-5 text-center"></i> Mutasi Stock
                    </a>
                    <a href="/card" class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium text-white hover:bg-white/20 transition">
                        <i class="fas fa-id-card w-5 text-center"></i> Card Stock
                    </a>
                    <a href="/reports" class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium bg-white/20 text-white">
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

        <!-- Main Content -->
        <main class="flex-1 p-6 main-content ml-64">
            <!-- Header -->
            <div class="bg-[#52C4D5] rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between mb-8 shadow">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-2">Pesanan User</h2>
                    <p class="text-white/90">Lihat dan kelola laporan pesanan user di sini.</p>
                </div>
                <div class="flex items-center gap-4 mt-4 md:mt-0">
                    <a href="/profile" class="text-white font-medium hover:underline">Profile</a>
                </div>
            </div>

            <!-- Main Section -->
            <section>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    @livewire('pesanan-user')
                </div>
            </section>
        </main>
    </div>

    @livewireScripts
</body>
</html>