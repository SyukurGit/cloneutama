{{-- resources/views/components/director-greeting.blade.php --}}
<section class="bg-white py-12 md:py-20">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap -mx-4 items-center">

            <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                <div class="relative mx-auto max-w-sm">
                    <div class="bg-gray-200 p-2 rounded-lg shadow-lg">
                        {{-- LOGIKA BARU UNTUK GAMBAR --}}
                        @if(app()->getLocale() == 'en' && !empty($settings['director_image']))
                            <img src="{{ asset('storage/' . $settings['director_image']) }}" alt="Foto Direktur" class="w-full rounded-md">
                        @else
                            <img src="{{ asset('images/direktur.png') }}" alt="Foto Direktur" class="w-full rounded-md">
                        @endif
                    </div>
                    <div class="absolute bottom-4 left-4 bg-gray-900 bg-opacity-70 text-white px-4 py-2 rounded-md">
                        {{-- LOGIKA BARU UNTUK NAMA & JABATAN (SAAT BAHASA INGGRIS) --}}
                        @if(app()->getLocale() == 'en')
                            <h3 class="font-bold text-lg">{{ $settings['director_name_en'] ?? __('db.director_greeting.name') }}</h3>
                            <p class="text-sm">{{ $settings['director_position_en'] ?? __('db.director_greeting.position') }}</p>
                        @else
                            {{-- Tampilan Default untuk Bahasa Indonesia --}}
                            <h3 class="font-bold text-lg">{{ __('db.director_greeting.name') }}</h3>
                            <p class="text-sm">{{ __('db.director_greeting.position') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 px-4">
                <div class="text-left">
                    {{-- LOGIKA BARU UNTUK KONTEN SAMBUTAN (SAAT BAHASA INGGRIS) --}}
                    @if(app()->getLocale() == 'en')
                        <p class="text-2xl font-bold uppercase tracking-wider text-red-600 mb-2">{{ $settings['director_greeting_title_en'] ?? __('db.director_greeting.title') }}</p>
                        <h2 class="text-2xl md:text-2xl font-semibold text-gray-800 mb-4">{{ $settings['director_greeting_intro_en'] ?? __('db.director_greeting.intro') }}</h2>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            {{-- nl2br untuk menjaga format paragraf dari textarea --}}
                            {!! nl2br(e($settings['director_greeting_body_en'] ?? __('db.director_greeting.body'))) !!}
                        </p>
                        <p class="text-gray-700 font-medium italic mt-6 text-lg">
                            "{{ $settings['director_greeting_slogan_en'] ?? __('db.director_greeting.slogan') }}"
                        </p>
                    @else
                        {{-- Tampilan Default untuk Bahasa Indonesia --}}
                        <p class="text-2xl font-bold uppercase tracking-wider text-red-600 mb-2">{{ __('db.director_greeting.title') }}</p>
                        <h2 class="text-2xl md:text-2xl font-semibold text-gray-800 mb-4">{{ __('db.director_greeting.intro') }}</h2>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            {{ __('db.director_greeting.body') }}
                        </p>
                        <p class="text-gray-700 font-medium italic mt-6 text-lg">
                            "{{ __('db.director_greeting.slogan') }}"
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>