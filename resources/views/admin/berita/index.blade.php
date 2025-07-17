@extends('layouts.admin')
@section('title', 'Manajemen Berita')
@section('header', 'Manajemen Artikel Berita')

@section('content')
<div class="container mx-auto" x-data="{ 
    layout: localStorage.getItem('news_layout') || 'grid',
    tagDropdownOpen: false,
    sortDropdownOpen: false
}">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Daftar Artikel</h2>
            <p class="text-sm text-gray-500">Kelola, filter, dan cari semua artikel berita.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="w-full sm:w-auto bg-red-600 hover:bg-red-400 text-white font-bold py-2 px-4 rounded-lg shadow-md flex-shrink-0 flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> Tulis Berita Baru
        </a>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-md mb-6">
        <form action="{{ route('admin.berita.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4 items-center">
                
                <div class="md:col-span-2 lg:col-span-3">
                    <div class="relative">
                        <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul berita..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <div class="relative" x-on:click.away="sortDropdownOpen = false">
                    <button @click="sortDropdownOpen = !sortDropdownOpen" type="button" class="w-full flex items-center justify-between px-4 py-2 border rounded-lg bg-gray-50">
                        <span class="text-sm font-medium text-gray-700">Urutkan</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>
                    <div x-show="sortDropdownOpen" x-transition class="absolute right-0 mt-1 w-full bg-white rounded-lg shadow-xl z-10 p-2 space-y-1" style="display: none;">
                        <a href="{{ route('admin.berita.index', array_merge(request()->query(), ['sort' => 'terbaru'])) }}" class="block px-3 py-1.5 text-sm rounded-md {{ $sort === 'terbaru' ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">Terbaru</a>
                        <a href="{{ route('admin.berita.index', array_merge(request()->query(), ['sort' => 'lama'])) }}" class="block px-3 py-1.5 text-sm rounded-md {{ $sort === 'lama' ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">Terlama</a>
                    </div>
                </div>

                <div class="relative" x-on:click.away="tagDropdownOpen = false">
                    <button @click="tagDropdownOpen = !tagDropdownOpen" type="button" class="w-full flex items-center justify-between px-4 py-2 border rounded-lg bg-gray-50">
                        <span class="text-sm font-medium text-gray-700">Kategori</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>
                    <div x-show="tagDropdownOpen" x-transition class="absolute right-0 mt-1 w-72 bg-white rounded-lg shadow-xl z-10 p-4" style="display: none;">
                        <p class="font-bold mb-2">Filter by Tags</p>
                        <div class="space-y-2 max-h-60 overflow-y-auto">
                            @foreach($tags as $tag)
                                <label class="flex items-center">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags ?? []) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $tag->name_en }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('admin.berita.index') }}" class="text-sm text-gray-600 hover:underline mr-4">Reset</a>
                            <button type="submit" class="bg-red-600 text-white text-sm font-semibold px-4 py-1.5 rounded-lg hover:bg-red-700">Terapkan</button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <button @click="layout = 'grid'; localStorage.setItem('news_layout', 'grid')" type="button" :class="{ 'bg-red-600 text-white': layout === 'grid', 'bg-gray-200 text-gray-600': layout !== 'grid' }" class="p-2 rounded-lg transition-colors">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button @click="layout = 'list'; localStorage.setItem('news_layout', 'list')" type="button" :class="{ 'bg-red-600 text-white': layout === 'list', 'bg-gray-200 text-gray-600': layout !== 'list' }" class="p-2 rounded-lg transition-colors">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div>
        <div x-show="layout === 'grid'" x-transition class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($newsItems as $news)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ $news->image_url }}" alt="News Image" class="w-full h-48 object-cover">
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($news->tags->take(2) as $tag)
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $tag->name_en }}</span>
                            @endforeach
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 leading-tight mb-2 flex-grow">{{ Str::limit($news->title, 60) }}</h3>
                        <div class="text-xs text-gray-500">
                            <span>Oleh: {{ $news->author }}</span> &bull;
                            {{-- INI BAGIAN YANG DIPERBAIKI --}}
                            <span>{{ optional($news->published_at)->format('d M Y') ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 border-t flex justify-between items-center">
                        <a href="{{ route('news.show', $news) }}" target="_blank" class="text-sm text-blue-600 hover:underline">Lihat</a>
                        <div class="flex gap-4">
                            <a href="{{ route('admin.berita.edit', $news) }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-800">Edit</a>
                            <form action="{{ route('admin.berita.destroy', $news) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">@csrf @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center py-12 text-gray-500">Tidak ada berita yang cocok dengan filter Anda.</p>
            @endforelse
        </div>

        <div x-show="layout === 'list'" x-transition class="bg-white rounded-lg shadow-lg overflow-hidden" style="display: none;">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Publikasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($newsItems as $news)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4"><img src="{{ $news->image_url }}" class="w-20 h-16 object-cover rounded-md"></td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-gray-900">{{ Str::limit($news->title, 50) }}</p>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($news->tags->take(3) as $tag)
                                        <span class="bg-gray-200 text-gray-700 text-xs px-2 py-0.5 rounded-full">{{ $tag->name_en }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $news->author }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{-- INI BAGIAN YANG DIPERBAIKI --}}
                                {{ optional($news->published_at)->format('d M Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('news.show', $news) }}" target="_blank" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                    <a href="{{ route('admin.berita.edit', $news) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('admin.berita.destroy', $news) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">@csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-12 text-gray-500">Tidak ada berita yang cocok dengan filter Anda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $newsItems->links() }}
    </div>
</div>
@endsection