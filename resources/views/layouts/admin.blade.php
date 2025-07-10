<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    
    {{-- ========================================================== --}}
    {{-- ==    TAMBAHKAN BARIS INI - INI ADALAH KUNCI SOLUSINYA    == --}}
    {{-- ========================================================== --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }"
            class="fixed z-40 inset-y-0 left-0 w-64 bg-gray-900 text-white transform transition duration-300 md:relative md:translate-x-0 md:flex-shrink-0">

            <div class="h-16 flex items-center justify-center bg-gray-800 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold tracking-wide text-white">
                    PANEL ADMIN
                </a>
            </div>

            <nav class="px-4 py-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.dashboard')) bg-gray-700 @endif">Dashboard Utama</a>
                <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.berita.*')) bg-gray-700 @endif">Berita</a>
                <a href="{{ route('admin.homepage_settings.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.homepage_settings.*')) bg-gray-700 @endif">Pengaturan Halaman Depan</a>
                <a href="{{ route('admin.program-studi.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.program-studi.*')) bg-gray-700 @endif">Manajemen Program Studi</a>
                <a href="{{ route('admin.director_settings.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.director_settings.*')) bg-gray-700 @endif">Sambutan Direktur</a>
                <a href="{{ route('admin.pimpinan.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.pimpinan.*')) bg-gray-700 @endif">Manajemen Pimpinan</a>
                <a href="{{ route('admin.testimonials.index') }}" class="block px-4 py-2 rounded-md hover:bg-gray-700 @if(request()->routeIs('admin.testimonials.*')) bg-gray-700 @endif">Manajemen Testimoni</a>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white shadow-md flex items-center justify-between px-4 md:px-6">
                <!-- Burger -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700 focus:outline-none md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Title -->
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800 flex-1 text-center md:text-left">@yield('header', 'Dashboard')</h1>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg">
                        Logout
                    </button>
                </form>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-100">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
