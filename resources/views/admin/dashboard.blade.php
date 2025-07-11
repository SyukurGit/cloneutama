@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Bagian 1: Kartu Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        
        {{-- Card Total Berita --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Total Berita</span>
                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\News::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-newspaper fa-lg text-red-600"></i>
            </div>
        </div>

        {{-- Card Program Studi --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Program Studi</span>
                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\StudyProgram::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-graduation-cap fa-lg text-blue-600"></i>
            </div>
        </div>

        {{-- Card Testimoni --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Total Testimoni</span>
                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Testimonial::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-comment-dots fa-lg text-green-600"></i>
            </div>
        </div>

        {{-- Card Pimpinan --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Jumlah Pimpinan</span>
                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Leadership::count() }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users fa-lg text-yellow-600"></i>
            </div>
        </div>

    </div>

    {{-- Bagian 2: Aktivitas Terbaru & Aksi Cepat --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Berita Terbaru --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm">
            <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Aktivitas Berita Terbaru</h3>
            <div class="space-y-4">
                @forelse (\App\Models\News::latest()->take(5)->get() as $news)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div>
                            <a href="{{ route('admin.berita.edit', $news) }}" class="font-semibold text-gray-700 hover:text-red-600">{{ $news->title }}</a>
                            <p class="text-xs text-gray-500">Oleh {{ $news->author }} &bull; {{ $news->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-xs font-bold px-2 py-1 rounded-full 
                            {{ $news->status == 'Posted' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $news->status }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-4">Belum ada berita yang ditulis.</p>
                @endforelse
            </div>
        </div>

        {{-- Kolom Kanan: Aksi Cepat --}}
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.berita.create') }}" class="w-full flex items-center justify-center bg-red-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-red-700 transition-all transform hover:scale-105">
                        <i class="fas fa-plus-circle mr-2"></i> Tulis Berita Baru
                    </a>
                    <a href="{{ route('admin.program-studi.create') }}" class="w-full flex items-center justify-center bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition-all transform hover:scale-105">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Program Studi
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Tautan Bermanfaat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('admin.homepage_settings.index') }}" class="text-gray-600 hover:text-red-600 flex items-center"><i class="fas fa-cog fa-fw mr-2"></i> Pengaturan Homepage</a></li>
                    <li><a href="{{ route('dashboard') }}" target="_blank" class="text-gray-600 hover:text-red-600 flex items-center"><i class="fas fa-external-link-alt fa-fw mr-2"></i> Lihat Situs Publik</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection