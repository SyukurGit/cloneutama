@props([
    'title' => config('app.name', 'Laravel'),
    'description' => 'Website resmi Pascasarjana UIN Ar-Raniry Banda Aceh. Menyediakan informasi akademik, program studi, berita terbaru, dan layanan mahasiswa.', // Deskripsi default
    'image' => asset('images/logo.png'), // Gambar default untuk media sosial
])

<title>{{ $title }}</title>

{{-- Meta Tags Dasar --}}
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="Pascasarjana, UIN Ar-Raniry, Banda Aceh, Magister, Doktor, Pendidikan Islam, Ekonomi Syariah">

{{-- Open Graph Meta Tags (untuk Facebook, LinkedIn, dll.) --}}
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">