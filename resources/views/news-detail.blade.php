<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Meta Tags untuk SEO & Social Media Share --}}
    <title>{{ $news->title }} - {{ config('app.name') }}</title>
    <meta name="description" content="{{ Str::limit(strip_tags($news->content), 155) }}">
    <meta name="author" content="{{ $news->author }}">
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($news->content), 155) }}" />
    <meta property="og:image" content="{{ asset('storage/' . $news->image) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary_large_image" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Menggunakan plugin typography dari Tailwind untuk styling otomatis --}}
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }
        
        /* Enhanced prose styling */
        .prose-custom {
            line-height: 1.8;
        }
        
        .prose-custom h1, .prose-custom h2, .prose-custom h3, .prose-custom h4, .prose-custom h5, .prose-custom h6 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .prose-custom p {
            margin-bottom: 1.5rem;
            color: #374151;
            text-align: justify;
        }
        
        .prose-custom img {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }
        
        .prose-custom a {
            color: #dc2626;
            text-decoration: none;
            font-weight: 500;
        }
        
        .prose-custom a:hover {
            color: #b91c1c;
            text-decoration: underline;
        }
        
        /* Card hover effects */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* Share button animations */
        .share-btn {
            transition: all 0.3s ease;
        }
        
        .share-btn:hover {
            transform: scale(1.1);
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .prose-custom {
                font-size: 16px;
            }
            
            .prose-custom h1 {
                font-size: 1.75rem;
            }
            
            .prose-custom h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-gray-100 font-sans antialiased">

    <x-navbar/>

    <main class="container mx-auto my-6 md:my-12 px-4 md:px-6">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 lg:gap-8 xl:gap-12">

            {{-- Kolom Utama: Konten Artikel --}}
            <div class="xl:col-span-2">
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                    
                    {{-- Header Artikel --}}
                    <header class="px-6 md:px-8 pt-6 md:pt-8 pb-6 border-b border-gray-100">
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight mb-4 md:mb-6">
                            {{ $news->title }}
                        </h1>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center space-x-3 text-sm text-gray-600">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-r from-red-600 to-red-900 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $news->author }}</span>
                                </div>
                                <span class="text-gray-400">•</span>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                    <time datetime="{{ $news->created_at->toIso8601String() }}" class="text-gray-600">
                                        {{ $news->created_at->translatedFormat('d F Y') }}
                                    </time>
                                </div>
                            </div>

                            {{-- Tombol Share --}}
                            <div class="flex items-center space-x-3" x-data="{ shareUrl: '{{ urlencode(url()->current()) }}', shareTitle: '{{ urlencode($news->title) }}' }">
                                <span class="text-sm font-medium text-gray-600">Share to:</span>
                                <div class="flex items-center space-x-2">
                                    <a :href="'https://api.whatsapp.com/send?text=' + shareTitle + '%0A' + shareUrl" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 share-btn">
                                        <i class="fab fa-whatsapp text-sm"></i>
                                    </a>
                                    <a :href="'https://twitter.com/intent/tweet?url=' + shareUrl + '&text=' + shareTitle" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-black text-white hover:bg-gray-800 share-btn">
                                        <i class="fab fa-twitter text-sm"></i>
                                    </a>
                                    <button @click="navigator.clipboard.writeText(decodeURIComponent(shareUrl)); alert('Link telah disalin!');" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-500 text-white hover:bg-gray-600 share-btn">
                                        <i class="fas fa-link text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </header>

                    {{-- Gambar Utama --}}
                   {{-- Gambar Utama --}}
{{-- Gambar Utama --}}
@if($news->image)
    <figure class="px-6 md:px-8 pt-6">
        <img src="{{ asset('storage/' . $news->image) }}" 
             {{-- UBAH BARIS DI BAWAH INI --}}
             class="w-full h-auto rounded-xl shadow-md" 
             alt="Gambar utama untuk {{ $news->title }}">
    </figure>
@endif

                    {{-- Isi Konten Berita --}}
                    <div class="px-6 md:px-8 py-6 md:py-8">
                        <div class="prose prose-lg max-w-none prose-custom">
                            {!! $news->content !!}
                        </div>
                    </div>

                </article>
            </div>

            {{-- Kolom Samping: Berita Terbaru Lainnya --}}
            <aside class="xl:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                        <div class="px-6 py-6 bg-gradient-to-r from-red-600 to-red-900">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <i class="fas fa-newspaper mr-2"></i>
                               Latest News
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-5">
                                @php
                                    // Ambil 5 berita terbaru, kecuali berita yang sedang dibaca
                                    $otherNews = \App\Models\News::where('id', '!=', $news->id)
                                        ->latest()
                                        ->take(5)
                                        ->get();
                                @endphp

                                @forelse($otherNews as $item)
                                    <a href="{{ route('news.show', $item) }}" class="block group">
                                        <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                            <div class="relative flex-shrink-0">
                                                <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/150' }}" 
                                                     class="w-20 h-20 object-cover rounded-lg shadow-sm" 
                                                     alt="{{ $item->title }}">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all"></div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-semibold text-gray-800 leading-tight group-hover:text-blue-600 transition-colors line-clamp-2 mb-2">
                                                    {{ Str::limit($item->title, 155) }}
                                                </h4>
                                                
                                                <div class="text-xs text-gray-500 space-y-1">
                                                    <div class="flex items-center space-x-1">
                                                        <i class="fas fa-user text-gray-400"></i>
                                                        <span class="font-medium">{{ $item->author }}</span>
                                                    </div>
                                                    <div class="flex items-center space-x-1">
                                                        <i class="fas fa-clock text-gray-400"></i>
                                                        <span>{{ $item->created_at->translatedFormat('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-8">
                                        <i class="fas fa-newspaper text-gray-300 text-4xl mb-3"></i>
                                        <p class="text-sm text-gray-500">Tidak ada berita lain untuk ditampilkan.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </main>
    
    <x-footer/>

</body>
</html>