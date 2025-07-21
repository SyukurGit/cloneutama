<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">
</head>
<body class="bg-gray-50 font-sans">

    <x-navbar/>

    <main class="container mx-auto my-8 px-4">
        <div class="text-left mb-12 border-b-2 border-red-600 pb-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">
                {{-- Use the English name of the active tag --}}
                {{ $activeTag ? $activeTag->name_en : 'News' }}
            </h1>
            <p class="mt-2 text-lg text-gray-600">
                {{ $activeTag ? 'Showing news in category:' : 'Find the latest news and information from Ar-Raniry Postgraduate School.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- Left Column: News List --}}
            <div class="lg:col-span-3">
                @if($newsItems->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($newsItems as $news)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                                <a href="{{ route('news.show', $news) }}" class="block">
                                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                                </a>
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3 class="text-lg font-bold text-gray-800 leading-tight group-hover:text-red-700 transition-colors mb-2 flex-grow">
                                        <a href="{{ route('news.show', $news) }}" class="hover:text-red-700">
                                            {{ Str::limit($news->title, 70) }}
                                        </a>
                                    </h3>
                                    
                                    @if($news->tags->isNotEmpty())
                                    <div class="flex flex-wrap items-center gap-2 mb-4">
                                        @foreach($news->tags->take(2) as $tag)
                                        <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2 py-1 rounded-full">
                                            #{{ Str::limit($tag->name_en, 15) }}
                                        </span>
                                        @endforeach
                                    </div>
                                    @endif
                                    
                                    <p class="text-xs text-gray-500 mt-auto">
                                        By {{ $news->author }} &bull; {{ \Carbon\Carbon::parse($news->published_at)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-12">
                        {{ $newsItems->withQueryString()->links() }}
                    </div>
                @else
                    <div class="text-center py-16 bg-white rounded-lg shadow-md">
                        <p class="text-gray-500 text-lg">No news found in this category.</p>
                    </div>
                @endif
            </div>

            {{-- Right Column: Categories Sidebar --}}
            {{-- Right Column: Categories Sidebar --}}
<aside class="lg:col-span-1">
    <div class="sticky top-24">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-800 border-b pb-3 mb-4">News Categories</h3>
            <ul class="space-y-2">
                {{-- Button to show all news --}}
                <li>
                    <a href="{{ route('news.index') }}" 
                       class="block px-3 py-2 rounded-md text-sm font-medium transition-colors
                              {{ !$activeTag ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        All News
                    </a>
                </li>
                
                {{-- PERUBAHAN DI BARIS INI --}}
                @foreach($tags as $tag)
                    <li>
                        <a href="{{ route('news.index', ['tag' => $tag->slug]) }}"
                           class="block px-3 py-2 rounded-md text-sm font-medium transition-colors
                                  {{ $activeTag && $activeTag->id == $tag->id ? 'bg-red-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            {{ $tag->name_en }}
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