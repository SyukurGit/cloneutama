@extends('layouts.admin')

@section('title', 'Pengaturan Halaman Depan')
@section('header', 'Pengaturan Halaman Depan')

@section('content')
<div class="container mx-auto">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Kita gunakan Alpine.js untuk UI dinamis --}}
    <form x-data="{ heroMediaType: '{{ old('hero_media_type', $settings['hero_media_type'] ?? 'image') }}' }" action="{{ route('admin.homepage_settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg space-y-12">

            {{-- ================================== --}}
            {{--       BAGIAN HERO CAROUSEL         --}}
            {{-- ================================== --}}
            <fieldset>
                <legend class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Pengaturan Hero Carousel</legend>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Tipe Media Latar Belakang</label>
                    <div class="mt-2 flex items-center gap-x-6">
                        <label>
                            <input type="radio" name="hero_media_type" value="image" x-model="heroMediaType">
                            <span class="ml-2">Gambar (Slideshow)</span>
                        </label>
                        <label>
                            <input type="radio" name="hero_media_type" value="video" x-model="heroMediaType">
                            <span class="ml-2">Video</span>
                        </label>
                    </div>
                </div>

                {{-- Opsi Upload Video --}}
                <div x-show="heroMediaType === 'video'" class="p-4 border-dashed border-2 rounded-lg">
                    <h4 class="font-semibold text-gray-700 mb-2">Upload Video</h4>
                    <input type="file" name="hero_video" accept="video/mp4,video/webm" class="block w-full text-sm">
                    @if(!empty($settings['hero_video_path']))
                        <p class="text-xs text-gray-500 mt-2">Video saat ini: {{ $settings['hero_video_path'] }}</p>
                    @endif
                </div>

                {{-- Opsi Upload Gambar --}}
                <div x-show="heroMediaType === 'image'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="p-4 border rounded-md space-y-3 shadow-sm">
                            <h4 class="font-bold">Slide {{ $i }}</h4>
                            
                            {{-- BAGIAN TEKS SLIDE SUDAH DIHAPUS --}}

                            <div>
                                <label for="hero_slide_{{ $i }}_image" class="block text-xs font-medium text-gray-600">Gambar Slide</label>
                                <input type="file" name="hero_slide_{{ $i }}_image" class="mt-1 block w-full text-sm">
                                @if(!empty($settings['hero_slide_' . $i . '_image']))
                                    <img src="{{ asset('storage/' . $settings['hero_slide_' . $i . '_image']) }}" class="mt-2 h-16 w-auto rounded">
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>

                {{-- Link Sosial Media --}}
                <div class="mt-8 border-t pt-6">
                     <h4 class="font-semibold text-gray-700 mb-4">Link Sosial Media</h4>
                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                         <div>
                            <label for="social_link_facebook" class="block text-sm font-medium text-gray-700">Facebook URL</label>
                            <input type="url" name="social_link_facebook" value="{{ $settings['social_link_facebook'] ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                         </div>
                         <div>
                            <label for="social_link_youtube" class="block text-sm font-medium text-gray-700">YouTube URL</label>
                            <input type="url" name="social_link_youtube" value="{{ $settings['social_link_youtube'] ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                         </div>
                         <div>
                            <label for="social_link_instagram" class="block text-sm font-medium text-gray-700">Instagram URL</label>
                            <input type="url" name="social_link_instagram" value="{{ $settings['social_link_instagram'] ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                         </div>
                     </div>
                 </div>
            </fieldset>

            {{-- ================================== --}}
            {{--        BAGIAN KEY FEATURES         --}}
            {{-- ================================== --}}
            <fieldset class="border-t-2 border-gray-200 pt-6">
                <legend class="text-xl font-semibold text-gray-800 mb-4">Pengaturan Key Features</legend>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="p-4 border rounded-md space-y-3 shadow-sm">
                             <h4 class="font-bold">Fitur {{ $i }}</h4>
                             <div>
                                <label for="key_feature_{{ $i }}_title_en" class="block text-xs font-medium text-gray-600">Judul (e.g. Why Us?)</label>
                                <input type="text" name="key_feature_{{ $i }}_title_en" value="{{ $settings['key_feature_' . $i . '_title_en'] ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                            </div>
                            <div>
                                <label for="key_feature_{{ $i }}_text_en" class="block text-xs font-medium text-gray-600">Teks Deskripsi</label>
                                <textarea name="key_feature_{{ $i }}_text_en" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">{{ $settings['key_feature_' . $i . '_text_en'] ?? '' }}</textarea>
                            </div>
                             <div>
                                <label for="key_feature_{{ $i }}_link" class="block text-xs font-medium text-gray-600">URL Tombol "Watch More"</label>
                                <input type="url" name="key_feature_{{ $i }}_link" value="{{ $settings['key_feature_' . $i . '_link'] ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                            </div>
                        </div>
                    @endfor
                </div>
            </fieldset>

            {{-- Tombol Simpan --}}
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection