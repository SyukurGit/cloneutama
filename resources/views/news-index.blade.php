<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>
<body class="bg-gray-50 font-sans">

    <x-navbar/>

    <main class="container mx-auto my-8 px-4">
        <div class="text-left mb-12 border-b-2 border-red-600 pb-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">
                {{ $activeTag ? $activeTag->name : 'Arsip Berita' }}
            </h1>
            <p class="mt-2 text-lg text-gray-600">
                {{ $activeTag ? 'Menampilkan berita dalam kategori:' : 'Temukan berita dan informasi terbaru dari Pascasarjana.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- Kolom Kiri: Daftar Berita --}}
            <div class="lg:col-span-3">
                @if($newsItems->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($newsItems as $news)
                            <a href="{{ route('news.show', $news) }}" class="block bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3 class="text-lg font-bold text-gray-800 leading-tight group-hover:text-red-700 transition-colors flex-grow">
                                        {{ Str::limit($news->title, 70) }}
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-4">
                                        Oleh {{ $news->author }} &bull; {{ \Carbon\Carbon::parse($news->published_at)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-12">
                        {{-- Menambahkan query 'tag' agar filter tetap aktif saat pindah halaman --}}
                        {{ $newsItems->withQueryString()->links() }}
                    </div>
                @else
                    <div class="text-center py-16 bg-white rounded-lg shadow-md">
                        <p class="text-gray-500 text-lg">Tidak ada berita yang ditemukan untuk kategori ini.</p>
                    </div>
                @endif
            </div>

            {{-- Kolom Kanan: Sidebar Kategori --}}
            <aside class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 border-b pb-3 mb-4">Kategori Berita</h3>
                        <ul class="space-y-2">
                            {{-- Tombol untuk menampilkan semua berita --}}
                            <li>
                                <a href="{{ route('news.index') }}" 
                                   class="block px-3 py-2 rounded-md text-sm font-medium transition-colors
                                          {{ !$activeTag || $activeTag->slug == 'postgraduate' ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                   Semua Berita
                                </a>
                            </li>
                            
                            @foreach($tags->where('slug', '!=', 'postgraduate') as $tag)
                                <li>
                                    <a href="{{ route('news.index', ['tag' => $tag->slug]) }}"
                                       class="block px-3 py-2 rounded-md text-sm font-medium transition-colors
                                              {{ $activeTag && $activeTag->id == $tag->id ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                        {{ $tag->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>

        </div>
    </main>
    
    <x-footer/>

</body>
</html>
