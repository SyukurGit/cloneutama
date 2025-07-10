<section class="bg-white py-12 md:py-20">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap -mx-4 items-center">

            <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                {{-- ========================================================== --}}
                {{--         PERUBAHAN HANYA PADA STRUKTUR DI BAWAH INI        --}}
                {{-- ========================================================== --}}
                <div class="relative max-w-xs mx-auto">
                    {{-- Ini adalah BINGKAI luar dengan padding untuk efek tebal --}}
                    <div class="bg-gray-300 p-1.5 rounded-lg shadow-lg">
                        {{-- GAMBAR di dalam bingkai --}}
                        @if(app()->getLocale() == 'en' && !empty($settings['director_image']))
                            <img src="{{ asset('storage/' . $settings['director_image']) }}" alt="Foto Direktur" class="w-full aspect-[4/5] object-cover rounded-md">
                        @else
                            <img src="{{ asset('images/direktur.png') }}" alt="Foto Direktur" class="w-full aspect-[4/5] object-cover rounded-md">
                        @endif
                    </div>

                    {{-- PAPAN NAMA (Overlay) --}}
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-900 bg-opacity-70 text-white text-left rounded-b-lg">
                        @if(app()->getLocale() == 'en')
                            <h3 class="font-bold text-lg">{{ $settings['director_name_en'] ?? __('db.director_greeting.name') }}</h3>
                            <p class="text-sm">{{ $settings['director_position_en'] ?? __('db.director_greeting.position') }}</p>
                        @else
                            <h3 class="font-bold text-lg">{{ __('db.director_greeting.name') }}</h3>
                            <p class="text-sm">{{ __('db.director_greeting.position') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- BAGIAN TEKS SAMBUTAN (TIDAK BERUBAH) --}}
            <div class="w-full lg:w-2/3 px-4">
                <div class="text-left">
                    {{-- ... (sisa kode teks sambutan tidak perlu diubah) ... --}}
                    @if(app()->getLocale() == 'en')
                        <p class="text-2xl font-bold uppercase tracking-wider text-red-600 mb-2">{{ $settings['director_greeting_title_en'] ?? __('db.director_greeting.title') }}</p>
                        <h2 class="text-2xl md:text-2xl font-semibold text-gray-800 mb-4">{{ $settings['director_greeting_intro_en'] ?? __('db.director_greeting.intro') }}</h2>
                        <p class="text-gray-600 leading-relaxed text-lg">{!! nl2br(e($settings['director_greeting_body_en'] ?? __('db.director_greeting.body'))) !!}</p>
                        <p class="text-gray-700 font-medium italic mt-6 text-lg">"{{ $settings['director_greeting_slogan_en'] ?? __('db.director_greeting.slogan') }}"</p>
                    @else
                        <p class="text-2xl font-bold uppercase tracking-wider text-red-600 mb-2">{{ __('db.director_greeting.title') }}</p>
                        <h2 class="text-2xl md:text-2xl font-semibold text-gray-800 mb-4">{{ __('db.director_greeting.intro') }}</h2>
                        <p class="text-gray-600 leading-relaxed text-lg">{{ __('db.director_greeting.body') }}</p>
                        <p class="text-gray-700 font-medium italic mt-6 text-lg">"{{ __('db.director_greeting.slogan') }}"</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>