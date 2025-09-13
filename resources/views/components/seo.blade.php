@props([
  'title' => config('app.name', 'Laravel'),
  'description' => 'Website resmi Pascasarjana UIN Ar-Raniry Banda Aceh. Menyediakan informasi akademik, program studi, berita terbaru, dan layanan mahasiswa.',
  // pastikan APP_URL benar agar asset() menghasilkan absolute URL
  'image' => asset('images/preview.jpg'),
  'canonical' => url()->current(),
])

<title>{{ $title }}</title>

{{-- Canonical & Robots --}}
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="index,follow">

{{-- Meta dasar --}}
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="Pascasarjana, UIN Ar-Raniry, Banda Aceh, Magister, Doktor, Pendidikan Islam, Ekonomi Syariah">

{{-- Open Graph --}}
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Pascasarjana UIN Ar-Raniry">
<meta property="og:locale" content="id_ID">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
