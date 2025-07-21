<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Meta Tags for SEO & Social Media Share --}}
    <title>{{ $news->title }} - {{ config('app.name') }}</title>
    <meta name="description" content="{{ Str::limit(strip_tags($news->content), 155) }}">
    <meta name="author" content="{{ $news->author }}">
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($news->content), 155) }}" />
    <meta property="og:image" content="{{ $news->image_url }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary_large_image" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .prose-custom p { text-align: justify; }
        .share-btn:hover { transform: scale(1.1); }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-gray-100 font-sans antialiased">

    <x-navbar/>

    <main class="container mx-auto my-6 md:my-12 px-4 md:px-6">

        {{-- =============================================== --}}
        {{--         THIS IS THE NEW "BACK" BUTTON           --}}
        {{-- =============================================== --}}
        <div class="mb-6">
            <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-semibold text-red-600 hover:text-red-800 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to All News 
            </a>
        </div>
        {{-- =============================================== --}}
        {{--               END OF NEW BUTTON                 --}}
        {{-- =============================================== --}}

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 lg:gap-8 xl:gap-12">

            {{-- Main Column: Article Content --}}
            <div class="xl:col-span-2">
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    
                    <figure class="relative bg-gray-200 rounded-t-2xl overflow-hidden">
    <img src="{{ $news->image_url }}" 
         class="absolute inset-0 w-full h-full object-cover filter blur-lg scale-110" 
         aria-hidden="true">

    <img src="{{ $news->image_url }}" 
         class="relative w-full h-auto max-h-[500px] object-contain mx-auto" 
         alt="Gambar utama untuk {{ $news->title }}">
</figure>

                    <div class="p-6 md:p-8">
                        {{-- Article Header --}}
                        <header class="pb-6 border-b border-gray-100">
                            
                            {{-- Tags/Categories --}}
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($news->tags as $tag)
                                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded-full">
                                        {{ $tag->name_en }}
                                    </span>
                                @endforeach
                            </div>

                            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight mb-6">
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
                                        <time datetime="{{ $news->published_at }}" class="text-gray-600">
                                            {{ optional($news->published_at)->translatedFormat('d F Y') }}
                                        </time>
                                    </div>
                                </div>

                                {{-- Share Buttons --}}
                                <div class="flex items-center space-x-3" x-data="{ shareUrl: '{{ urlencode(url()->current()) }}', shareTitle: '{{ urlencode($news->title) }}' }">
                                    <span class="text-sm font-medium text-gray-600">Share to:</span>
                                    <div class="flex items-center space-x-2">
                                        <a :href="'https://api.whatsapp.com/send?text=' + shareTitle + '%0A' + shareUrl" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 share-btn transition-transform"><i class="fab fa-whatsapp text-sm"></i></a>
                                        <a :href="'https://twitter.com/intent/tweet?url=' + shareUrl + '&text=' + shareTitle" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-black text-white hover:bg-gray-800 share-btn transition-transform"><i class="fab fa-twitter text-sm"></i></a>
                                        <button @click="navigator.clipboard.writeText(decodeURIComponent(shareUrl)); alert('Link has been copied!');" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-500 text-white hover:bg-gray-600 share-btn transition-transform"><i class="fas fa-link text-sm"></i></button>
                                    </div>
                                </div>
                            </div>
                        </header>

                        {{-- Article Content --}}
                        <div class="prose prose-lg max-w-none prose-custom mt-6">
                            {!! $news->content !!}
                        </div>
                    </div>

                </article>
            </div>

            {{-- Sidebar: Other Latest News --}}
            <aside class="xl:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="px-6 py-6 bg-gradient-to-r from-red-600 to-red-900">
                            <h3 class="text-xl font-bold text-white flex items-center"><i class="fas fa-newspaper mr-2"></i> Latest News</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-5">
                                @php
                                    $otherNews = \App\Models\News::where('id', '!=', $news->id)->latest('published_at')->take(5)->get();
                                @endphp

                                @forelse($otherNews as $item)
                                    <a href="{{ route('news.show', $item) }}" class="block group">
                                        <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                            <div class="relative flex-shrink-0">
                                                <img src="{{ $item->image_url }}" class="w-20 h-20 object-cover rounded-lg shadow-sm" alt="{{ $item->title }}">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all"></div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-semibold text-gray-800 leading-tight group-hover:text-red-600 transition-colors line-clamp-2 mb-2">
                                                    {{ Str::limit($item->title, 155) }}
                                                </h4>
                                                <div class="text-xs text-gray-500 space-y-1">
                                                    <div class="flex items-center space-x-1"><i class="fas fa-user text-gray-400"></i><span class="font-medium">{{ $item->author }}</span></div>
                                                    <div class="flex items-center space-x-1"><i class="fas fa-clock text-gray-400"></i><span>{{ optional($item->published_at)->translatedFormat('d M Y') }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-8"><i class="fas fa-newspaper text-gray-300 text-4xl mb-3"></i><p class="text-sm text-gray-500">No other news to display.</p></div>
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