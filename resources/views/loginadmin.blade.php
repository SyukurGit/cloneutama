<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen" style="background-image: url('{{ asset('images/bg3.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    
    <!-- Overlay untuk memberikan efek gelap pada background -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    
    <div class="relative flex items-center justify-center min-h-screen px-4 py-8">
        <div class="w-full max-w-md p-8 space-y-6 bg-white bg-opacity-95 backdrop-blur-sm rounded-xl shadow-2xl">
            
            <!-- Logo Section -->
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-16 w-auto">
                </div>
                <h2 class="text-3xl font-bold text-gray-800">English Control Panel</h2>
                <p class="mt-2 text-gray-600">Silakan login untuk melanjutkan</p>
            </div>

            {{-- Menampilkan pesan error validasi --}}
            @error('email')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @enderror

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200"
                           value="{{ old('email') }}">
                </div>

                {{-- Input Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 transform hover:scale-105">
                        Sign In
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-red-500 no-underline hover:underline transition-colors duration-200">
                    &larr; Kembali ke Situs
                </a>
            </div>
        </div>
    </div>

</body>
</html>