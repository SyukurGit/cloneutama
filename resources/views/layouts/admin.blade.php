<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body class="bg-gray-100 font-sans">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 overflow-hidden">
        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-900 text-gray-200 transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

            <!-- Logo -->
            <div class="h-16 flex items-center justify-center bg-gray-900 border-b border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold tracking-wider text-white">
                    PANEL ADMIN
                </a>
            </div>

            <!-- Menu -->
            <nav class="flex-1 px-2 py-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.dashboard')) bg-gray-700 text-white @endif">
                    <span class="mx-4 font-medium">Dashboard Utama</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.berita.*')) bg-gray-700 text-white @endif">
                    <span class="mx-4 font-medium">Berita english</span>
                </a>
                <a href="{{ route('admin.homepage_settings.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">
                    <span class="mx-4 font-medium">Pengaturan Halaman Depan</span>
                </a>
                <a href="{{ route('admin.program-studi.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.program-studi.*')) bg-gray-700 text-white @endif">
    <span class="mx-4 font-medium">Manajemen Program Studi</span>
</a>
                <a href="{{ route('admin.director_settings.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.director_settings.*')) bg-gray-700 text-white @endif">
    <span class="mx-4 font-medium">Sambutan Direktur</span>
</a>
{{-- Letakkan ini di bawah menu lainnya --}}
<a href="{{ route('admin.pimpinan.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.pimpinan.*')) bg-gray-700 text-white @endif">
    <span class="mx-4 font-medium">Manajemen Pimpinan</span>
</a>
<a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.testimonials.*')) bg-gray-700 text-white @endif">
    <span class="mx-4 font-medium">Manajemen Testimoni</span>
</a>
            </nav>
        </aside>

        <!-- Overlay Mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black opacity-50 transition-opacity md:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white shadow-sm flex justify-between items-center px-6">
                <!-- Burger Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none md:hidden">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <!-- Title -->
                <h1 class="text-2xl font-semibold text-gray-700 text-center w-full md:w-auto">@yield('header', 'Dashboard')</h1>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="hidden md:inline">
                    @csrf
                    <button type="submit" class="text-sm bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none">
                        Logout
                    </button>
                </form>
            </header>

            <!-- Dynamic Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>


    
@stack('scripts')
</body>
</html>
