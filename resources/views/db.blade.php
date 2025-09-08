<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<x-seo title="Beranda - Pascasarjana UIN Ar-Raniry" />
    
    {{-- Memuat file CSS dan JS yang sudah dikompilasi oleh Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">

    
</head>
<body class="bg-gray-100 font-sans">

    {{-- panggil navbar --}}
    <x-navbar/>
    
    {{-- Memanggil komponen Carousel --}}
    <x-hero-carousel/>

    {{-- Memanggil komponen Fitur Utama --}}
    <x-key-features/>

    {{-- Memanggil komponen Berita Terbaru --}}
    <x-latest-news :newsItems="$newsItems" />

    {{-- Memanggil komponen Program Studi --}}
    <x-study-programs/>

    {{-- Memanggil komponen Sambutan Direktur --}}
    <x-director-greeting/>

    {{-- info section --}}
    <x-info-section/>

 {{-- infomasi --}}
@if($informations->isNotEmpty())
    <x-information-section :informations="$informations" />
@endif
    
    {{-- fasilitas --}}
    {{-- <x-facilities-grid/> --}}
    <x-facilities-grid :facilities="$facilities" />


   



    <x-alumni-testimonials :testimonials="$testimonials" />
    {{-- <x-alumni-testimonials/> --}}

    {{-- <x-leadership-team/> --}}
    <x-leadership-team :leaders="$leaders" />
    
   {{-- footer --}}
    <x-footer/>

</body>
</html>