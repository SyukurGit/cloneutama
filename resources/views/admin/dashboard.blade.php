@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Control Situs Inggris Pasca Ar-Raniry')

@section('content')
<div class="space-y-8">

    {{-- Kartu Statistik (Sekarang menggunakan variabel dari controller) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Total Berita</span>
                <p class="text-3xl font-bold text-gray-800">{{ $newsCount }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-newspaper fa-lg text-red-600"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Program Studi</span>
                <p class="text-3xl font-bold text-gray-800">{{ $studyProgramCount }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-graduation-cap fa-lg text-blue-600"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Total Testimoni</span>
                <p class="text-3xl font-bold text-gray-800">{{ $testimonialCount }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-comment-dots fa-lg text-green-600"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Jumlah Pimpinan</span>
                <p class="text-3xl font-bold text-gray-800">{{ $leadershipCount }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users fa-lg text-yellow-600"></i>
            </div>
        </div>
    </div>

    {{-- Kartu Selamat Datang --}}
    <div class="bg-gradient-to-r from-red-700 to-red-900 text-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h2>
        @can('isSuperAdmin')
            <p class="mt-2 text-red-100">Anda berada di pusat kendali situs. Gunakan menu navigasi di bawah untuk mengelola seluruh konten website Anda.</p>
        @else
            <p class="mt-2 text-red-100">Anda hanya memiliki akses untuk mengelola semua konten yang berhubungan dengan Berita saja dan beberapa Fitur dibatasi untuk anda.</p>
        @endcan
    </div>

    {{-- Menu Manajemen Utama --}}
    <div>
        <h3 class="text-xl font-bold text-gray-700 mb-4">Menu Manajemen Utama </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <a href="{{ route('admin.berita.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-newspaper fa-lg text-red-600"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">Manajemen Berita</h4>
                    <p class="text-sm text-gray-500 mt-1">Tambah, edit, atau hapus artikel berita.</p>
                </div>
            </a>

            @can('isSuperAdmin')
                <a href="{{ route('admin.homepage_settings.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-desktop fa-lg text-blue-600"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Halaman Depan</h4>
                        <p class="text-sm text-gray-500 mt-1">Ubah konten carousel, fitur, dan link sosial media.</p>
                    </div>
                </a>
                <a href="{{ route('admin.pimpinan.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-users fa-lg text-yellow-600"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Manajemen Pimpinan</h4>
                        <p class="text-sm text-gray-500 mt-1">Kelola daftar dan profil pimpinan.</p>
                    </div>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-comment-dots fa-lg text-green-600"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Manajemen Testimoni</h4>
                        <p class="text-sm text-gray-500 mt-1">Atur testimoni yang ditampilkan di halaman depan.</p>
                    </div>
                </a>
                <a href="{{ route('admin.director_settings.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-user-tie fa-lg text-indigo-600"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Sambutan Direktur</h4>
                        <p class="text-sm text-gray-500 mt-1">Ubah teks dan foto sambutan direktur.</p>
                    </div>
                </a>
                <a href="{{ route('admin.program-studi.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-graduation-cap fa-lg text-purple-600"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Program Studi</h4>
                        <p class="text-sm text-gray-500 mt-1">Kelola daftar program studi S2 dan S3.</p>
                    </div>
                </a>
            @endcan
        </div>
    </div>
</div>
@endsection