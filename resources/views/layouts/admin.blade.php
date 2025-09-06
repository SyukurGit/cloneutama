<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">

    <style>
        /* Transisi untuk sidebar */
        .sidebar-transition { transition: width 0.3s ease-in-out, transform 0.3s ease-in-out; }
        .content-transition { transition: margin-left 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div x-data="{ 
            isSidebarOpen: window.innerWidth > 768 ? true : false, 
            isUserMenuOpen: false 
        }" 
        x-init="$watch('isSidebarOpen', value => {
            if (window.innerWidth <= 768) return;
            localStorage.setItem('sidebarOpen', value);
        }); isSidebarOpen = (window.innerWidth > 768 && localStorage.getItem('sidebarOpen') === 'true')"
        class="relative min-h-screen md:flex"
    >
        {{-- Sidebar --}}
        <aside 
            :class="{ 
                'translate-x-0': isSidebarOpen && window.innerWidth <= 768, 
                '-translate-x-full': !isSidebarOpen && window.innerWidth <= 768,
                'w-64': isSidebarOpen && window.innerWidth > 768,
                'w-20': !isSidebarOpen && window.innerWidth > 768
            }"
            class="fixed inset-y-0 left-0 bg-gray-900 text-white shadow-lg z-30 sidebar-transition md:translate-x-0"
        >
           <div class="h-16 flex items-center justify-center px-4 bg-gray-100 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}">
                    <img x-show="isSidebarOpen" src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto bg-white p-100 rounded-md shadow-sm">
                    <img x-show="!isSidebarOpen" src="{{ asset('images/logouin.png') }}" alt="Logo Ikon" class="h-10 w-10">
                </a>
            </div>

           <nav class="px-4 py-4 space-y-2">
                @php
                    $navLinks = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard Utama', 'icon' => 'fa-home', 'role' => 'any'],
                        ['route' => 'admin.berita.index', 'label' => 'Berita', 'icon' => 'fa-newspaper', 'role' => 'any'],
                        ['route' => 'admin.homepage_settings.index', 'label' => 'Halaman Depan', 'icon' => 'fa-desktop', 'role' => 'superadmin'],
                        ['route' => 'admin.program-studi.index', 'label' => 'Program Studi', 'icon' => 'fa-graduation-cap', 'role' => 'superadmin'],
                        ['route' => 'admin.facilities.index', 'label' => 'Fasilitas', 'icon' => 'fa-building', 'role' => 'superadmin'],

                        ['route' => 'admin.director_settings.index', 'label' => 'Sambutan Direktur', 'icon' => 'fa-user-tie', 'role' => 'superadmin'],
                        ['route' => 'admin.info_section.edit', 'label' => 'Info Section', 'icon' => 'fa-info-circle', 'role' => 'superadmin'],
                        ['route' => 'admin.pimpinan.index', 'label' => 'Pimpinan', 'icon' => 'fa-users', 'role' => 'superadmin'],
                        ['route' => 'admin.testimonials.index', 'label' => 'Testimoni', 'icon' => 'fa-comment-dots', 'role' => 'superadmin'],
                        ['route' => 'admin.users.index', 'label' => 'Setting Akun', 'icon' => 'fa-users-cog', 'role' => 'superadmin'],
                        ['route' => 'admin.activity_log.index', 'label' => 'Riwayat Log', 'icon' => 'fa-history', 'role' => 'superadmin'],
                        ['route' => 'admin.about', 'label' => 'Tentang Panel Ini', 'icon' => 'fa-info-circle', 'role' => 'any'],
                    ];
                @endphp

                @foreach ($navLinks as $link)
                    @if($link['role'] == 'any' || auth()->user()->role == 'superadmin')
                        <a href="{{ route($link['route']) }}" 
                           class="flex items-center px-4 py-2.5 rounded-lg hover:bg-gray-700 transition-colors duration-200 
                                  @if(request()->routeIs(str_replace('.index', '.*', $link['route']))) bg-red-600 @endif"
                           :title="isSidebarOpen ? '' : '{{ $link['label'] }}'">
                            <i class="fas {{ $link['icon'] }} fa-fw" :class="{ 'mr-3': isSidebarOpen }"></i>
                            <span x-show="isSidebarOpen" class="flex-1">{{ $link['label'] }}</span>
                        </a>
                    @else
                        <div class="flex items-center px-4 py-2.5 rounded-lg text-gray-500 cursor-not-allowed"
                             :title="isSidebarOpen ? '' : '{{ $link['label'] }} (Akses Ditolak)'">
                            <i class="fas {{ $link['icon'] }} fa-fw" :class="{ 'mr-3': isSidebarOpen }"></i>
                            <span x-show="isSidebarOpen" class="flex-1">{{ $link['label'] }}</span>
                        </div>
                    @endif
                @endforeach
            </nav>
        </aside>

        {{-- Backdrop untuk mobile --}}
        <div x-show="isSidebarOpen && window.innerWidth <= 768" class="fixed inset-0 bg-black opacity-50 z-20" @click="isSidebarOpen = false"></div>

        {{-- =============================================== --}}
        {{--            PERUBAHAN UTAMA ADA DI SINI          --}}
        {{-- =============================================== --}}
        {{-- Content Area --}}
        {{-- Hapus kelas "overflow-hidden" dari div ini --}}
        <div class="flex-1 flex flex-col content-transition" 
             :class="{ 'md:ml-64': isSidebarOpen, 'md:ml-20': !isSidebarOpen }">
            
            {{-- Header --}}
            {{-- Tambahkan kelas "sticky top-0 z-10" di sini --}}
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 md:px-6 sticky top-0 z-10">
                {{-- Tombol untuk Toggle Sidebar --}}
                <button @click="isSidebarOpen = !isSidebarOpen" class="text-gray-600 hover:text-red-600 focus:outline-none">
                    <i class="fas fa-bars fa-lg"></i>
                </button>

                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>

                {{-- Menu User --}}
                <div class="relative">
                    <button @click="isUserMenuOpen = !isUserMenuOpen" class="flex items-center space-x-2">
                        <span class="hidden md:inline text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        <div class="w-9 h-9 bg-red-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </button>
                    <div x-show="isUserMenuOpen" @click.away="isUserMenuOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20" style="display: none;">
                        <a href="{{ route('dashboard') }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lihat Situs -></a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm font-semibold text-red-600 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>