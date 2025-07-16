@props(['newsItems']) {{-- Menerima data berita dari controller --}}

<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        
        {{-- Bagian Header (Struktur Tetap Sama) --}}
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center">
                <span class="w-10 h-1 bg-red-600 rounded-full"></span>
                <h2 class="ml-4 text-3xl font-bold text-gray-800">Latest News</h2>
            </div>
            <a href="{{ route('news.index') }}" class="hidden md:inline-block bg-gray-800 text-white font-semibold px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm">
                Lihat Semua Berita
            </a>
        </div>

        @if($newsItems->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-8">
                
                {{-- Berita Utama (Paling Kiri) --}}
                <div class="col-span-1">
                    @php $firstNews = $newsItems->first(); @endphp
                    <a href="{{ route('news.show', $firstNews) }}" class="block group no-underline">
                        <div class="relative">
                            {{-- PERBAIKAN 1: Menggunakan image_url --}}
                            <img src="{{ $firstNews->image_url }}" alt="{{ $firstNews->title }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                            <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black to-transparent rounded-b-lg"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h3 class="text-2xl font-bold text-white leading-tight group-hover:underline">
                                    {{ $firstNews->title }}
                                </h3>
                                {{-- PERBAIKAN 2: Menggunakan published_at --}}
                                <p class="text-gray-300 mt-2">{{ $firstNews->author }} | {{ \Carbon\Carbon::parse($firstNews->published_at)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Daftar Berita Lainnya (Sebelah Kanan) --}}
                <div class="col-span-1 mt-8 lg:mt-0">
                    <div class="space-y-6">
                        @foreach($newsItems->skip(1)->take(3) as $news)
                            <a href="{{ route('news.show', $news) }}" class="flex items-center gap-4 group no-underline">
                                {{-- PERBAIKAN 3: Menggunakan image_url --}}
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-24 h-24 object-cover rounded-lg flex-shrink-0">
                                <div>
                                    <h4 class="font-bold text-gray-800 group-hover:text-red-600 transition-colors">
                                        {{ $news->title }}
                                    </h4>
                                    {{-- PERBAIKAN 4: Menggunakan published_at --}}
                                    <p class="text-sm text-gray-500 mt-1">{{ $news->author }} | {{ \Carbon\Carbon::parse($news->published_at)->translatedFormat('d F Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Tombol "Lihat Semua" untuk Tampilan Mobile --}}
            <div class="text-center mt-12 md:hidden">
                <a href="#" class="inline-block bg-gray-800 text-white font-semibold px-8 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                    Lihat Semua Berita
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif
    </div>
</section>
