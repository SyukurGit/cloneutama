@php
    // ======================================================================
    // DATA PROGRAM STUDI DENGAN LINK
    // Ganti nilai '#...' dengan URL tujuan Anda.
    // ======================================================================
    $studyPrograms = [
        // Magister (S2)
        ['key' => 's2_tafsir',           'link' => 'https://pps.ar-raniry.ac.id/program-studi/ilmu-al-quran-dan-tafsir-s2/'],
        ['key' => 's2_islamic_studies',  'link' => '#link-untuk-s2-studi-islam'],
        ['key' => 's2_islamic_education','link' => 'https://pps.ar-raniry.ac.id/program-studi/pendidikan-agama-islam-s2/'],
        ['key' => 's2_family_law',       'link' => '#link-untuk-s2-hukum-keluarga'],
        ['key' => 's2_islamic_economics','link' => 'https://pps.ar-raniry.ac.id/program-studi/ekonomi-syariah-s2/'],
        ['key' => 's2_communication',    'link' => '#link-untuk-s2-kpi'],
        ['key' => 's2_arabic_education', 'link' => 'https://pps.ar-raniry.ac.id/program-studi/pendidikan-bahasa-arab-s2/'],
        // Doktor (S3)
        ['key' => 's3_islamic_economics','link' => 'https://pps.ar-raniry.ac.id/program-studi/ekonomi-syariah-s3/'],
        ['key' => 's3_islamic_studies',  'link' => 'https://pps.ar-raniry.ac.id/program-studi/studi-islam-s3/'],
        ['key' => 's3_islamic_education','link' => 'https://pps.ar-raniry.ac.id/program-studi/pendidikan-agama-islam-s3/'],
        ['key' => 's3_fiqh',             'link' => 'https://pps.ar-raniry.ac.id/program-studi/fiqih-modern-s3/'],
    ];
@endphp

<nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Kampus Site Logo" class="h-14 w-auto">
                </a>
            </div>

            {{-- MENU DESKTOP --}}
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-red-600 font-bold' : 'text-gray-600 hover:text-red-600' }}">{{ __('db.navbar.home') }}</a>
                
                {{-- PERBAIKAN --}}
                <a href="{{ route('profile.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('profile.index') ? 'text-red-600 font-bold' : 'text-gray-600 hover:text-red-600' }}">{{ __('db.navbar.profile') }}</a>
                
                {{-- Dropdown Program Studi (di-klik) --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-gray-600 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">
                        <span>{{ __('db.navbar.study_programs') }}</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open"
                         @click.away="open = false"
                         x-transition
                         class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-20" 
                         style="display: none;">
                        @foreach($studyPrograms as $program)
                            <a href="{{ $program['link'] }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-700">{{ __('db.study_programs.programs.' . $program['key']) }}</a>
                        @endforeach
                    </div>
                </div>
                
                {{-- Dropdown Akademik (di-klik) --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-gray-600 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">
                        <span>{{ __('db.navbar.academics') }}</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open"
                         @click.away="open = false"
                         x-transition
                         class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-20"
                         style="display: none;">
                        <a href="https://pps.ar-raniry.ac.id/daftar-sidang/" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 hover:text-red-700">{{ __('db.navbar.thesis_defense_schedule') }}</a>
                    </div>
                </div>
                
                <a href="https://pps.ar-raniry.ac.id/kpm-singkil" target="_blank" class="text-gray-600 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">{{ __('db.navbar.service') }}</a>
                <a href="https://pps.ar-raniry.ac.id/penelitian/" target="_blank" class="text-gray-600 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">{{ __('db.navbar.research') }}</a>
                <a href="https://pps.ar-raniry.ac.id/gugus-penjaminan-mutu/" target="_blank" class="text-gray-600 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">{{ __('db.navbar.quality') }}</a>

                {{-- PERBAIKAN --}}
                <a href="{{ route('news.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('news.*') ? 'text-red-600 font-bold' : 'text-gray-600 hover:text-red-600' }}">{{ __('db.navbar.news') }}</a>
            </div>

            {{-- Tombol Mobile & Pilihan Bahasa --}}
            <div class="flex items-center">
                <div class="relative me-4" x-data="{ langOpen: false }">
                     <button @click="langOpen = !langOpen" class="flex items-center space-x-2 px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-100 focus:outline-none transition-colors">
                         @if(app()->getLocale() == 'id')
                             <span class="flex items-center justify-center bg-gray-200 rounded-sm p-0.5">
                                 <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 6"><rect width="9" height="3" fill="#E31D1A"/><rect y="3" width="9" height="3" fill="#F7F7F7"/></svg>
                             </span>
                             <span>ID</span>
                         @else
                             <span class="flex items-center justify-center bg-gray-200 rounded-sm p-0.5">
                                 <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 30"><clipPath id="a"><path d="M0 0v30h60V0z"/></clipPath><path d="M0 0v30h60V0z" fill="#012169"/><path d="m0 0 60 30m0-30L0 30" stroke="#fff" stroke-width="6" clip-path="url(#a)"/><path d="m0 0 60 30m0-30L0 30" stroke="#C8102E" stroke-width="4" clip-path="url(#a)"/><path d="M30 0v30M0 15h60" stroke="#fff" stroke-width="10" clip-path="url(#a)"/><path d="M30 0v30M0 15h60" stroke="#C8102E" stroke-width="6" clip-path="url(#a)"/></svg>
                             </span>
                             <span>EN</span>
                         @endif
                         <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                     </button>
                    <div x-show="langOpen" @click.away="langOpen = false" x-transition class="absolute right-0 mt-2 py-1 w-40 bg-white rounded-md shadow-xl z-20" style="display: none;">
                        <a href="{{ route('lang.switch', 'id') }}" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <span class="flex items-center justify-center bg-gray-200 rounded-sm p-0.5">
                                <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 6"><rect width="9" height="3" fill="#E31D1A"/><rect y="3" width="9" height="3" fill="#F7F7F7"/></svg>
                            </span>
                            <span>Indonesia</span>
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <span class="flex items-center justify-center bg-gray-200 rounded-sm p-0.5">
                                <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 30"><clipPath id="b"><path d="M0 0v30h60V0z"/></clipPath><path d="M0 0v30h60V0z" fill="#012169"/><path d="m0 0 60 30m0-30L0 30" stroke="#fff" stroke-width="6" clip-path="url(#b)"/><path d="m0 0 60 30m0-30L0 30" stroke="#C8102E" stroke-width="4" clip-path="url(#b)"/><path d="M30 0v30M0 15h60" stroke="#fff" stroke-width="10" clip-path="url(#b)"/><path d="M30 0v30M0 15h60" stroke="#C8102E" stroke-width="6" clip-path="url(#b)"/></svg>
                            </span>
                            <span>English</span>
                        </a>
                    </div>
                </div>
                
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div x-show="mobileMenuOpen" class="md:hidden" x-transition style="display: none;">
        <div @click.away="mobileMenuOpen = false" class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-gray-50' }}">{{ __('db.navbar.home') }}</a>
            
            {{-- PERBAIKAN --}}
            <a href="{{ route('profile.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('profile.index') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">{{ __('db.navbar.profile') }}</a>
            
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">
                    <span>{{ __('db.navbar.study_programs') }}</span>
                    <svg class="w-5 h-5 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                    @foreach($studyPrograms as $program)
                        <a href="{{ $program['link'] }}" target="_blank" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-red-50 hover:text-red-700">{{ __('db.study_programs.programs.' . $program['key']) }}</a>
                    @endforeach
                </div>
            </div>
            
            <div x-data="{ open: false }">
                 <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">
                     <span>{{ __('db.navbar.academics') }}</span>
                     <svg class="w-5 h-5 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                 </button>
                <div x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                    <a href="https://pps.ar-raniry.ac.id/daftar-sidang/" target="_blank" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-red-50 hover:text-red-700">{{ __('db.navbar.thesis_defense_schedule') }}</a>
                </div>
            </div>
            <a href="https://pps.ar-raniry.ac.id/kpm-singkil" target="_blank" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">{{ __('db.navbar.service') }}</a>
            <a href="https://pps.ar-raniry.ac.id/penelitian/" target="_blank" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">{{ __('db.navbar.research') }}</a>
            <a href="https://pps.ar-raniry.ac.id/gugus-penjaminan-mutu/" target="_blank" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">{{ __('db.navbar.quality') }}</a>

            {{-- PERBAIKAN --}}
            <a href="{{ route('news.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('news.*') ? 'bg-red-50 text-red-600' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">{{ __('db.navbar.news') }}</a>
        </div>
    </div>
</nav>