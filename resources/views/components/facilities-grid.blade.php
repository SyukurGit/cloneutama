@php
    // Data untuk gambar fasilitas (tidak berubah)
    $facilities = [
        ['image' => 'ruangdoktor.jpg', 'text_key' => 'facilities.items.0'],
        ['image' => 'default-news2.png', 'text_key' => 'facilities.items.1'],
        ['image' => 'fasilitas-3.jpg', 'text_key' => 'facilities.items.2'],
        ['image' => 'fasilitas-4.jpg', 'text_key' => 'facilities.items.3'],
        ['image' => 'fasilitas-5.jpg', 'text_key' => 'facilities.items.4'],
        ['image' => 'fasilitas-6.jpg', 'text_key' => 'facilities.items.5'],
        ['image' => 'fasilitas-7.jpg', 'text_key' => 'facilities.items.6'],
        ['image' => 'fasilitas-8.jpg', 'text_key' => 'facilities.items.7'],
        ['image' => 'fasilitas-9.jpg', 'text_key' => 'facilities.items.8'],
    ];
@endphp

<section class="bg-gray-100 py-16 md:py-24">
    <div class="container mx-auto px-6">
        {{-- Judul Seksi --}}
        <div class="flex items-center mb-12">
            <span class="w-10 h-1 bg-red-600 rounded-full"></span>
            <h2 class="ml-4 text-3xl font-bold text-black">{{ __('db.facilities.section_title') }}</h2>
        </div>

        {{-- Grid untuk Fasilitas --}}
        <div class="flex flex-col items-center">
            <div class="max-w-6xl mx-auto w-full">
                {{-- Mobile Carousel --}}
                <div class="md:hidden">
                    <div class="relative">
                        <div class="overflow-hidden rounded-lg">
                            <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
                                @foreach ($facilities as $facility)
                                <div class="w-full flex-shrink-0">
                                    <div class="relative rounded-lg overflow-hidden group shadow-lg mx-2">
                                        <img src="{{ asset('images/' . $facility['image']) }}" alt="{{ __($facility['text_key']) }}" class="w-full h-48 object-cover">
                                        <div class="absolute inset-0 bg-black opacity-20 group-hover:opacity-40 transition-opacity duration-300"></div>
                                        
                                        {{-- =============================================== --}}
                                        {{--        INI LABEL BARU UNTUK TAMPILAN MOBILE       --}}
                                        {{-- =============================================== --}}
                                        <div class="absolute top-0 left-0">
                                            <div class="bg-red-600 bg-opacity-80 backdrop-blur-sm text-white px-4 py-2 rounded-br-lg shadow-md">
                                                <h3 class="font-bold text-sm">{{ __($facility['text_key']) }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- Navigation Buttons --}}
                        <button id="prevBtn" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-60 text-white p-3 rounded-full hover:bg-opacity-80 transition-all z-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button id="nextBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-60 text-white p-3 rounded-full hover:bg-opacity-80 transition-all z-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                        
                        {{-- Dots Indicator --}}
                        <div class="flex justify-center mt-6 space-x-2">
                            @foreach ($facilities as $index => $facility)
                            <button class="dot w-3 h-3 rounded-full bg-gray-400 hover:bg-gray-600 transition-colors" data-index="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Desktop Grid --}}
                <div class="hidden md:grid grid-cols-3 gap-4 justify-items-center">
                    @foreach ($facilities as $facility)
                    <div class="relative rounded-lg overflow-hidden group shadow-lg w-full max-w-xs md:max-w-md lg:max-w-lg">
                        <img src="{{ asset('images/' . $facility['image']) }}" alt="{{ __($facility['text_key']) }}" class="w-full h-32 md:h-40 lg:h-44 object-cover">
                        <div class="absolute inset-0 bg-black opacity-20 group-hover:opacity-40 transition-opacity duration-300"></div>

                        {{-- =============================================== --}}
                        {{--       INI LABEL BARU UNTUK TAMPILAN DESKTOP     --}}
                        {{-- =============================================== --}}
                        <div class="absolute top-0 left-0">
                            <div class="bg-red-600 bg-opacity-100 backdrop-blur-sm text-white px-5 py-2 rounded-br-lg shadow-md">
                                <h3 class="font-bold text-sm md:text-base">{{ __($facility['text_key']) }}</h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Carousel JavaScript (Tidak Diubah) --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const carousel = document.getElementById('carousel');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const dots = document.querySelectorAll('.dot');
                
                let currentIndex = 0;
                const totalItems = {{ count($facilities) }};
                let autoPlayInterval;
                
                function updateCarousel() {
                    const translateX = -currentIndex * 100;
                    carousel.style.transform = `translateX(${translateX}%)`;
                    
                    // Update dots
                    dots.forEach((dot, index) => {
                        if (index === currentIndex) {
                            dot.classList.remove('bg-gray-400');
                            dot.classList.add('bg-gray-600');
                        } else {
                            dot.classList.remove('bg-gray-600');
                            dot.classList.add('bg-gray-400');
                        }
                    });
                }
                
                function nextSlide() {
                    currentIndex = (currentIndex + 1) % totalItems;
                    updateCarousel();
                }
                
                function prevSlide() {
                    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                    updateCarousel();
                }
                
                function startAutoPlay() {
                    autoPlayInterval = setInterval(nextSlide, 3000); // Pindah setiap 3 detik
                }
                
                function stopAutoPlay() {
                    if (autoPlayInterval) {
                        clearInterval(autoPlayInterval);
                    }
                }
                
                // Button events
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    stopAutoPlay();
                    setTimeout(startAutoPlay, 5000); // Restart autoplay setelah 5 detik
                });
                
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    stopAutoPlay();
                    setTimeout(startAutoPlay, 5000); // Restart autoplay setelah 5 detik
                });
                
                // Dot events
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        currentIndex = index;
                        updateCarousel();
                        stopAutoPlay();
                        setTimeout(startAutoPlay, 5000); // Restart autoplay setelah 5 detik
                    });
                });
                
                // Pause autoplay when hovering over carousel
                carousel.addEventListener('mouseenter', stopAutoPlay);
                carousel.addEventListener('mouseleave', startAutoPlay);
                
                // Initialize
                updateCarousel();
                startAutoPlay();
            });
        </script>
    </div>
</section>