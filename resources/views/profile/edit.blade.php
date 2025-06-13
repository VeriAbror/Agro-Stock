<!-- filepath: resources/views/profile/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-[#52C4D5] rounded-b-2xl shadow p-6 mb-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
                <h2 class="text-2xl font-bold text-white mb-2 md:mb-0">Profile</h2>
                <a href="/dashboard" class="text-white font-medium hover:underline">Kembali ke Dashboard</a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                <div class="p-6 bg-white shadow rounded-lg">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-6 bg-white shadow rounded-lg">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>