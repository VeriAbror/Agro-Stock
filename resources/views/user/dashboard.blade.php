<!-- filepath: resources/views/user/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-[#52C4D5] px-4 md:px-6 py-4 flex items-center justify-between shadow flex-wrap">
        <div class="flex items-center gap-3">
            <i class="fas fa-leaf text-white text-2xl"></i>
            <span class="text-white font-bold text-xl tracking-wide">AgroStock</span>
        </div>
        <!-- Hamburger for mobile -->
        <div class="md:hidden">
            <button id="menu-btn" class="text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        <div id="menu"
            class="w-full md:w-auto flex-col md:flex-row items-center gap-6 mt-4 md:mt-0
            transition-all duration-300 ease-in-out
            opacity-0 scale-95 pointer-events-none
            md:opacity-100 md:scale-100 md:pointer-events-auto
            md:flex hidden">
            <a href="/master" class="block md:inline text-white font-medium hover:underline transition px-2 py-2">Master Stock</a>
            <a href="/reports" class="block md:inline text-white font-medium hover:underline transition px-2 py-2">Pesanan Saya</a>
            <a href="/profile" class="block md:inline text-white font-medium hover:underline transition px-2 py-2">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="ml-0 md:ml-4 mt-2 md:mt-0 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition w-full md:w-auto">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex flex-col items-center justify-center mt-12 md:mt-16 px-2 md:px-4">
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 max-w-lg w-full flex flex-col items-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User" class="w-20 h-20 md:w-24 md:h-24 rounded-full border-4 border-[#52C4D5] mb-4 shadow">
            <h1 class="text-xl md:text-2xl font-bold text-[#52C4D5] mb-2 text-center">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 text-center mb-4">Anda login sebagai <span class="font-semibold text-[#52C4D5]">User</span>. Silakan gunakan menu di atas untuk mengakses data master stock atau pesanan Anda.</p>
        </div>
    </main>

    <script>
        // Responsive navbar toggle with smooth transition
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');
        btn && btn.addEventListener('click', () => {
            if(menu.classList.contains('opacity-0')) {
                menu.classList.remove('hidden', 'opacity-0', 'scale-95', 'pointer-events-none');
                menu.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
            } else {
                menu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                setTimeout(() => menu.classList.add('hidden'), 300); // match duration-300
                menu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            }
        });
    </script>
</body>
</html>