<!-- filepath: resources/views/user/master.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Stock</title>
    @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans text-gray-800 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-[#52C4D5] px-4 md:px-6 py-4 flex items-center justify-between shadow">
        <div class="flex items-center gap-3">
            <i class="fas fa-leaf text-white text-2xl"></i>
            <span class="text-white font-bold text-xl tracking-wide">AgroStock</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="/dashboard" class="text-white font-medium hover:underline">Back</a>
            <a href="/profile" class="text-white font-medium hover:underline">Profile</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex flex-col items-center justify-center mt-10 px-2 md:px-4">
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 max-w-3xl w-full">
            <h1 class="text-2xl font-bold text-[#52C4D5] mb-6 text-center">Master Stock</h1>
            @livewire('master-stock')
        </div>
    </main>

    @livewireScripts
</body>
</html>