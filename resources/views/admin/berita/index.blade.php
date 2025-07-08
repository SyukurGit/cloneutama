@extends('layouts.admin')

@section('title', 'Daftar Berita')
@section('header', 'Manajemen Berita')

@section('content')
<div class="container mx-auto">
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex justify-between items-center border-b">
            <h2 class="text-xl font-bold text-gray-800">Daftar Semua Berita</h2>
            {{-- Tombol ini mengarah ke route 'create' yang baru --}}
            <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                + Tambah Berita
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Gambar</th>
                        <th class="py-3 px-6 text-left">Judul</th>
                        <th class="py-3 px-6 text-center">Tanggal</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($newsItems as $news)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                @if($news->image)
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="News Image" class="w-20 h-12 object-cover rounded">
                                @else
                                    <div class="w-20 h-12 bg-gray-300 flex items-center justify-center rounded">
                                        <span class="text-xs text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex flex-col">
                                    <span class="font-medium">ID: {{ Str::limit($news->title_id, 40) }}</span>
                                    <span class="text-gray-500 text-xs">EN: {{ Str::limit($news->title_en, 40) }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span>{{ $news->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center gap-2">
                                    {{-- Tombol hapus ini menggunakan route 'destroy' yang baru --}}
                                    <form action="{{ route('admin.berita.destroy', $news) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                        @csrf
                                        @method('DELETE') {{-- Method spoofing untuk DELETE --}}
                                        <button type="submit" class="bg-red-200 hover:bg-red-300 text-red-600 font-bold py-1 px-3 rounded-full text-xs">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                Tidak ada berita yang ditemukan. Silakan tambah berita baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection