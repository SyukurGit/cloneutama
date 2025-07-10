@extends('layouts.admin')

@section('title', 'Pengaturan Halaman Depan')
@section('header', 'Pengaturan Halaman Depan Carousel dan Content')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form x-data="{ heroMediaType: '{{ old('hero_media_type', $settings['hero_media_type'] ?? 'image') }}' }" action="{{ route('admin.homepage_settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- ================================== --}}
            {{--       BAGIAN HERO CAROUSEL         --}}
            {{-- ================================== --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Pengaturan Hero Carousel
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola tampilan utama halaman depan website</p>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Media Type Selection --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">Tipe Media Latar Belakang</label>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="hero_media_type" value="image" x-model="heroMediaType" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-blue-600">Gambar (Slideshow)</span>
                            </label>
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="hero_media_type" value="video" x-model="heroMediaType" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-blue-600">Video</span>
                            </label>
                        </div>
                    </div>

                    {{-- Video Upload Section --}}
                    <div x-show="heroMediaType === 'video'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="bg-gradient-to-br from-purple-50 to-indigo-50 border-2 border-dashed border-purple-300 rounded-lg p-6">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-purple-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <h4 class="mt-4 text-lg font-semibold text-gray-900">Upload Video</h4>
                            <p class="mt-2 text-sm text-gray-600">Pilih file video untuk latar belakang hero section</p>
                        </div>
                        <div class="mt-4">
                            <input type="file" name="hero_video" accept="video/mp4,video/webm" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                            @if(!empty($settings['hero_video_path']))
                                <div class="mt-3 p-3 bg-white rounded-md border">
                                    <p class="text-sm text-gray-700">Video saat ini: <span class="font-medium">{{ $settings['hero_video_path'] }}</span></p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Image Upload Section --}}
                    <div x-show="heroMediaType === 'image'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="font-semibold text-gray-900">Slide {{ $i }}</h4>
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span class="text-blue-600 font-bold text-sm">{{ $i }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div>
                                            <label for="hero_slide_{{ $i }}_image" class="block text-xs font-medium text-gray-600 mb-2">Gambar Slide</label>
                                            <input type="file" name="hero_slide_{{ $i }}_image" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                            @if(!empty($settings['hero_slide_' . $i . '_image']))
                                                <div class="mt-2 relative">
                                                    <img src="{{ asset('storage/' . $settings['hero_slide_' . $i . '_image']) }}" class="h-16 w-full object-cover rounded-md border">
                                                    <div class="absolute top-1 right-1 bg-green-500 text-white text-xs px-1 py-0.5 rounded">
                                                        ✓
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Social Media Links --}}
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Link Sosial Media
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label for="social_link_facebook" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd" />
                                    </svg>
                                    Facebook URL
                                </label>
                                <input type="url" name="social_link_facebook" value="{{ $settings['social_link_facebook'] ?? '' }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="social_link_youtube" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2 4.75C2 3.784 2.784 3 3.75 3h12.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0116.25 17H3.75A1.75 1.75 0 012 15.25V4.75zM8 12.25V7.75l5.25 2.25L8 12.25z" clip-rule="evenodd" />
                                    </svg>
                                    YouTube URL
                                </label>
                                <input type="url" name="social_link_youtube" value="{{ $settings['social_link_youtube'] ?? '' }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="social_link_instagram" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2C7.794 2 7.556 2.01 6.648 2.048 5.742 2.086 5.12 2.222 4.574 2.42A3.573 3.573 0 002.42 4.574c-.198.546-.334 1.168-.372 2.074C2.01 7.556 2 7.794 2 10s.01 2.444.048 3.352c.038.906.174 1.528.372 2.074.2.546.478 1.01.874 1.406.396.396.86.674 1.406.874.546.198 1.168.334 2.074.372C7.556 17.99 7.794 18 10 18s2.444-.01 3.352-.048c.906-.038 1.528-.174 2.074-.372a3.573 3.573 0 001.406-.874c.396-.396.674-.86.874-1.406.198-.546.334-1.168.372-2.074C17.99 12.444 18 12.206 18 10s-.01-2.444-.048-3.352c-.038-.906-.174-1.528-.372-2.074a3.573 3.573 0 00-.874-1.406 3.573 3.573 0 00-1.406-.874c-.546-.198-1.168-.334-2.074-.372C12.444 2.01 12.206 2 10 2zm0 1.622c2.172 0 2.445.01 3.307.048.798.036 1.23.166 1.519.276.382.148.655.325.942.612.287.287.464.56.612.942.11.289.24.721.276 1.519.038.862.048 1.135.048 3.307s-.01 2.445-.048 3.307c-.036.798-.166 1.23-.276 1.519-.148.382-.325.655-.612.942-.287.287-.56.464-.942.612-.289.11-.721.24-1.519.276-.862.038-1.135.048-3.307.048s-2.445-.01-3.307-.048c-.798-.036-1.23-.166-1.519-.276a2.507 2.507 0 01-.942-.612 2.507 2.507 0 01-.612-.942c-.11-.289-.24-.721-.276-1.519C3.632 12.445 3.622 12.172 3.622 10s.01-2.445.048-3.307c.036-.798.166-1.23.276-1.519.148-.382.325-.655.612-.942.287-.287.56-.464.942-.612.289-.11.721-.24 1.519-.276.862-.038 1.135-.048 3.307-.048zM10 5.378a4.622 4.622 0 100 9.244 4.622 4.622 0 000-9.244zM10 13a3 3 0 110-6 3 3 0 010 6zm5.884-7.804a1.078 1.078 0 11-2.156 0 1.078 1.078 0 012.156 0z" clip-rule="evenodd" />
                                    </svg>
                                    Instagram URL
                                </label>
                                <input type="url" name="social_link_instagram" value="{{ $settings['social_link_instagram'] ?? '' }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================================== --}}
            {{--        BAGIAN KEY FEATURES         --}}
            {{-- ================================== --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pengaturan Key Features
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola fitur-fitur utama yang akan ditampilkan</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow duration-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-semibold text-gray-900">Fitur {{ $i }}</h4>
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-green-600 font-bold text-sm">{{ $i }}</span>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="key_feature_{{ $i }}_title_en" class="block text-sm font-medium text-gray-700 mb-2">Judul (e.g. Why Us?)</label>
                                        <input type="text" name="key_feature_{{ $i }}_title_en" value="{{ $settings['key_feature_' . $i . '_title_en'] ?? '' }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                                    </div>
                                    <div>
                                        <label for="key_feature_{{ $i }}_text_en" class="block text-sm font-medium text-gray-700 mb-2">Teks Deskripsi</label>
                                        <textarea name="key_feature_{{ $i }}_text_en" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm resize-none">{{ $settings['key_feature_' . $i . '_text_en'] ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <label for="key_feature_{{ $i }}_link" class="block text-sm font-medium text-gray-700 mb-2">URL Tombol "Watch More"</label>
                                        <input type="url" name="key_feature_{{ $i }}_link" value="{{ $settings['key_feature_' . $i . '_link'] ?? '' }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- Save Button --}}
            <div class="flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection