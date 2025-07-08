@php
    // Ambil teks statis dari file bahasa.
    $carouselTexts = __('db.carousel_slides');
    
    // Pastikan carousel texts memiliki 5 item sesuai yang didefinisikan
    if (empty($carouselTexts) || count($carouselTexts) < 5) {
        $carouselTexts = [
            '1' => 'INNOVATIVE',
            '2' => 'NATIONALISTIC', 
            '3' => 'EXCELLENT',
            '4' => 'RELIGIOUS',
            '5' => 'RESPONSIVE',
        ];
    }

    // Siapkan data gambar dinamis dari database, jika ada.
    $dynamicImages = [];
    for ($i = 1; $i <= 5; $i++) {
        if (!empty($settings['hero_slide_' . $i . '_image'])) {
            $dynamicImages[] = $settings['hero_slide_' . $i . '_image'];
        }
    }
@endphp

<div
    class="relative w-full h-[32rem] bg-gray-800"
    {{-- Inisialisasi Alpine.js untuk slideshow teks SELALU AKTIF --}}
    x-data="{ activeTextSlide: 1, totalTextSlides: {{ count($carouselTexts) }} }"
    x-init="setInterval(() => { activeTextSlide = (activeTextSlide % totalTextSlides) + 1 }, 3000)"
>
    @if(!empty($settings['hero_media_type']) && $settings['hero_media_type'] === 'video' && !empty($settings['hero_video_path']))
        {{-- Jika Admin memilih VIDEO --}}
        <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline>
            <source src="{{ asset('storage/' . $settings['hero_video_path']) }}" type="video/mp4">
        </video>
    @elseif(!empty($dynamicImages))
        {{-- Jika Admin memilih GAMBAR (dan ada gambar yang di-upload) --}}
        <div
            x-data="{ activeImageSlide: 1, totalImageSlides: {{ count($dynamicImages) }} }"
            x-init="setInterval(() => { activeImageSlide = (activeImageSlide % totalImageSlides) + 1 }, 3000)"
        >
            @foreach ($dynamicImages as $index => $image)
                <div
                    x-show="activeImageSlide === {{ $index + 1 }}"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-700"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0"
                >
                    <img src="{{ asset('storage/' . $image) }}" alt="Carousel Image {{ $index + 1 }}" class="w-full h-full object-cover">
                </div>
            @endforeach
        </div>
    @else
        {{-- Tampilan DEFAULT jika tidak ada media yang di-upload --}}
        <img src="{{ asset('images/carousel-1.jpg') }}" alt="Default Carousel Image" class="w-full h-full object-cover">
    @endif

    <div class="absolute inset-0 bg-black opacity-40"></div>

    {{-- SLIDESHOW TEKS (Selalu berjalan) --}}
    <div class="absolute inset-0 flex items-center justify-center p-4">
        @foreach ($carouselTexts as $index => $text)
            {{-- PERUBAHAN UTAMA ADA DI BLOK DIV DI BAWAH INI --}}
            <div
                x-show="activeTextSlide === {{ $index }}"
                x-transition:enter="transition ease-out duration-800"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-400"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 flex items-center justify-center" {{-- Pastikan posisi tetap center --}}
            >
                 <h2 class="text-white text-5xl md:text-7xl font-bold text-center drop-shadow-2xl">
                    {{ $text }}
                </h2>
            </div>
        @endforeach
    </div>

    {{-- Tombol navigasi titik (hanya muncul jika slideshow gambar aktif) --}}
    @if(!empty($dynamicImages) && (empty($settings['hero_media_type']) || $settings['hero_media_type'] === 'image'))
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-3 z-10">
            @foreach ($dynamicImages as $index => $image)
                <button
                    @click="activeImageSlide = {{ $index + 1 }}; activeTextSlide = {{ $index + 1 }}"
                    :class="{ 'bg-white': activeImageSlide === {{ $index + 1 }}, 'bg-white/50': activeImageSlide !== {{ $index + 1 }} }"
                    class="w-3 h-3 rounded-full hover:bg-white transition"></button>
            @endforeach
        </div>
    @endif

    <div class="absolute z-10 flex space-x-4 bottom-20 left-1/2 -translate-x-1/2 md:flex-col md:space-y-4 md:space-x-0 md:top-1/2 md:left-auto md:right-8 md:-translate-y-1/2">
        <a href="{{ $settings['social_link_instagram'] ?? '#' }}" target="_blank" class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.917 3.917 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.445.01 10.173 0 8 0zm0 1.442c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.282.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.282.11-.705.24-1.485-.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.275-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.843-.038 1.096-.047 3.232-.047z"/><path d="M8 4.202c-2.105 0-3.797 1.692-3.797 3.797s1.692 3.797 3.797 3.797 3.797-1.692 3.797-3.797S10.105 4.202 8 4.202zm0 6.153c-1.305 0-2.357-1.052-2.357-2.357S6.695 5.643 8 5.643 10.357 6.695 10.357 8s-1.052 2.357-2.357 2.357z"/><path d="M12.601 2.898a1.442 1.442 0 1 1-2.884 0 1.442 1.442 0 0 1 2.884 0z"/></svg>
        </a>
        <a href="{{ $settings['social_link_youtube'] ?? '#' }}" target="_blank" class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M10 15.5V8.5L16 12L10 15.5Z" /><path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12ZM12 20.5C16.6944 20.5 20.5 16.6944 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 16.6944 7.30558 20.5 12 20.5Z" /></svg>
        </a>
        <a href="{{ $settings['social_link_facebook'] ?? '#' }}" target="_blank" class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0 0 3.603 0 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
        </a>
    </div>
</div>