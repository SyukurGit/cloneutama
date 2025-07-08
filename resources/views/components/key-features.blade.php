<div class="relative">
    <div class="container mx-auto px-6 -mt-16 relative z-10">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- KOTAK FITUR 1 --}}
            <div class="bg-white p-8 rounded-lg shadow-lg text-center flex flex-col">
                <div class="flex-grow">
                    {{-- Ikon Asli (Tetap dipertahankan) --}}
                    <div class="w-16 h-16 bg-blue-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    {{-- Konten Dinamis --}}
                    @if(app()->getLocale() == 'en')
                        <h3 class="font-bold text-xl text-gray-800 mb-3">{{ $settings['key_feature_1_title_en'] ?? __('db.key_features.feature1_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ $settings['key_feature_1_text_en'] ?? __('db.key_features.feature1_text') }}</p>
                    @else
                        <h3 class="font-bold text-xl text-gray-800 mb-3">{{ __('db.key_features.feature1_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ __('db.key_features.feature1_text') }}</p>
                    @endif
                </div>
                {{-- Link Tombol Dinamis --}}
                <a href="{{ $settings['key_feature_1_link'] ?? '#' }}" class="mt-6 inline-block px-5 py-2 border border-gray-800 text-gray-800 rounded-lg text-sm font-semibold no-underline hover:bg-red-600 hover:text-white transition-colors duration-300">
                    Watch More
                </a>
            </div>

            {{-- KOTAK FITUR 2 --}}
            <div class="bg-white p-8 rounded-lg shadow-lg text-center flex flex-col">
                 <div class="flex-grow">
                    {{-- Ikon Asli (Tetap dipertahankan) --}}
                    <div class="w-16 h-16 bg-blue-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    {{-- Konten Dinamis --}}
                    @if(app()->getLocale() == 'en')
                        <h3 class="font-bold text-xl text-gray-800 mb-3">{{ $settings['key_feature_2_title_en'] ?? __('db.key_features.feature2_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ $settings['key_feature_2_text_en'] ?? __('db.key_features.feature2_text') }}</p>
                    @else
                        <h3 class="font-bold text-xl text-gray-800 mb-3">{{ __('db.key_features.feature2_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ __('db.key_features.feature2_text') }}</p>
                    @endif
                </div>
                {{-- Link Tombol Dinamis --}}
                <a href="{{ $settings['key_feature_2_link'] ?? '#' }}" class="mt-6 inline-block px-5 py-2 border border-gray-800 text-gray-800 rounded-lg text-sm font-semibold no-underline hover:bg-red-600 hover:text-white transition-colors duration-300">
                    Watch More
                </a>
            </div>

            {{-- KOTAK FITUR 3 --}}
            <div class="bg-white p-8 rounded-lg shadow-lg text-center flex flex-col">
                 <div class="flex-grow">
                    {{-- Ikon Asli (Tetap dipertahankan) --}}
                    <div class="w-16 h-16 bg-blue-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    
                    {{-- Konten Dinamis --}}
                    @if(app()->getLocale() == 'en')
                        <h3 class="font-bold text-xl text-gray-800 mb-3">{{ $settings['key_feature_3_title_en'] ?? __('db.key_features.feature3_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ $settings['key_feature_3_text_en'] ?? __('db.key_features.feature3_text') }}</p>
                    @else
                        <h3 class="font-bold text-xl text-gray-800 mb-3">{{ __('db.key_features.feature3_title') }}</h3>
                        <p class="text-gray-600 text-sm">{{ __('db.key_features.feature3_text') }}</p>
                    @endif
                </div>
                {{-- Link Tombol Dinamis --}}
                <a href="{{ $settings['key_feature_3_link'] ?? '#' }}" class="mt-6 inline-block px-5 py-2 border border-gray-800 text-gray-800 rounded-lg text-sm font-semibold no-underline hover:bg-red-600 hover:text-white transition-colors duration-300">
                    Watch More
                </a>
            </div>

        </div>
    </div>
</div>