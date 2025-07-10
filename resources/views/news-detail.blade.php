<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Judul halaman sekarang lebih sederhana dan dinamis --}}
    <title>{{ $news->title }} - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Menambahkan plugin tipografi untuk tampilan artikel yang rapi --}}
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
</head>
<body class="bg-gray-50 font-sans">

    {{-- Navbar Anda --}}
    <x-navbar/>

    <main class="container mx-auto my-10 px-4">
        {{-- Kontainer utama untuk artikel --}}
        <article class="max-w-4xl mx-auto bg-white p-6 sm:p-8 lg:p-10 rounded-lg shadow-lg">
            
            {{-- Header Artikel --}}
            <header class="mb-8 text-center">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">
                    {{ $news->title }}
                </h1>
                
                {{-- Metadata Penulis dan Tanggal --}}
                <div class="mt-6 flex items-center justify-center space-x-4 text-sm text-gray-500">
                    <span>By: <span class="font-semibold text-gray-700">{{ $news->author }}</span></span>
                    <span class="hidden sm:inline">&bull;</span>
                    <time datetime="{{ $news->created_at->toIso8601String() }}">
                        {{ $news->created_at->format('d F Y') }}
                    </time>
                </div>
            </header>

            {{-- Gambar Utama --}}
            @if($news->image)
                <figure class="mb-8">
                    <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-auto rounded-lg shadow-md" alt="Gambar Utama Berita">
                </figure>
            @endif

            {{-- Isi Konten Berita --}}
            {{-- Class 'prose' akan otomatis menata HTML dari editor Anda --}}
            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                {!! $news->content !!}
            </div>

        </article>
    </main>
    
    {{-- Footer Anda --}}
    <x-footer/>

</body>
</html>