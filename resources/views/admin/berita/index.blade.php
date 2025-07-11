@extends('layouts.admin')
@section('title', 'Daftar Berita')
@section('header', 'Manajemen Berita')

@section('content')
<div class="container mx-auto">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Daftar Artikel Berita</h2>
        <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
            + Tulis Berita Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($newsItems as $news)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://via.placeholder.com/400x200' }}" alt="News Image" class="w-full h-48 object-cover">
                <div class="p-4 flex flex-col flex-grow">
                    <div class="flex justify-end items-center mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                            {{ $news->status }}
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 leading-tight mb-2 flex-grow">{{ Str::limit($news->title, 60) }}</h3>
                    <div class="text-xs text-gray-500">
                        <span>Oleh: {{ $news->author }}</span> &bull;
                        <span>{{ $news->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 border-t flex justify-between items-center">
                    <a href="{{ route('news.show', $news) }}" target="_blank" class="text-sm text-blue-600 hover:underline">Lihat</a>
                    <div class="flex gap-4">
                        {{-- PERBAIKAN DI SINI --}}
                        <a href="{{ route('admin.berita.edit', $news) }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-800">Edit</a>
                        
                        {{-- PERBAIKAN DI SINI --}}
                        <form action="{{ route('admin.berita.destroy', $news) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-md">
                <p class="text-gray-500 text-lg">Tidak ada berita. Silakan tulis berita baru.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection