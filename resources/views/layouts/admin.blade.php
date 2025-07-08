<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body class="bg-gray-100 font-sans">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-gray-200 transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">

            <div class="h-16 flex items-center justify-center bg-gray-900 border-b border-gray-800">
                <a href="{{ route('dashboard') }}" target="_blank" class="text-xl font-bold tracking-wider text-white">
                    KAMPUS SITE
                </a>
            </div>
            <nav class="flex-1 px-2 py-4 space-y-2">
                <a href="{{ route('admin.news.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.news.index')) bg-gray-700 text-white @endif">
                    <span class="mx-4 font-medium">Daftar Berita</span>
                </a>
                <a href="{{ route('admin.input') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.input')) bg-gray-700 text-white @endif">
                    <span class="mx-4 font-medium">Tambah Berita</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 text-gray-300 rounded-md hover:bg-gray-700 hover:text-white @if(request()->routeIs('admin.settings.index')) bg-gray-700 text-white @endif">
        <span class="mx-4 font-medium">Pengaturan Halaman</span>
    </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="h-16 bg-white shadow-sm flex justify-between items-center px-6">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none md:hidden">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>

                <h1 class="text-2xl font-semibold text-gray-700">@yield('header', 'Dashboard')</h1>

                <div class="flex items-center">
                    <span class="mr-4 text-gray-600 hidden sm:block">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>