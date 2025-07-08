@extends('layouts.admin')

@section('title', 'Pengaturan Sambutan & Sosmed')
@section('header', 'Pengaturan Sambutan Direktur & Sosial Media')

@section('content')
<div class="container mx-auto">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Form ini sekarang mengarah ke route baru kita --}}
    <form action="{{ route('admin.director_settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white p-8 rounded-lg shadow-lg space-y-8">

            {{-- Bagian Sambutan Direktur --}}
            <fieldset class="border-t pt-6">
                <legend class="text-xl font-semibold text-gray-800 px-2">Sambutan Direktur (English)</legend>
                <div class="mt-4 space-y-4">
                    <div>
                        <label for="director_greeting_title_en" class="block text-sm font-medium text-gray-700">Judul Atas (e.g. --A WORD FROM THE DIRECTOR--)</label>
                        <input type="text" name="director_greeting_title_en" id="director_greeting_title_en" value="{{ old('director_greeting_title_en', $settings['director_greeting_title_en'] ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                     <div>
                        <label for="director_name_en" class="block text-sm font-medium text-gray-700">Nama Direktur</label>
                        <input type="text" name="director_name_en" id="director_name_en" value="{{ old('director_name_en', $settings['director_name_en'] ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                     <div>
                        <label for="director_position_en" class="block text-sm font-medium text-gray-700">Jabatan Direktur</label>
                        <input type="text" name="director_position_en" id="director_position_en" value="{{ old('director_position_en', $settings['director_position_en'] ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="director_greeting_intro_en" class="block text-sm font-medium text-gray-700">Intro Sambutan</label>
                        <input type="text" name="director_greeting_intro_en" id="director_greeting_intro_en" value="{{ old('director_greeting_intro_en', $settings['director_greeting_intro_en'] ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="director_greeting_body_en" class="block text-sm font-medium text-gray-700">Isi Sambutan</label>
                        <textarea name="director_greeting_body_en" id="director_greeting_body_en" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('director_greeting_body_en', $settings['director_greeting_body_en'] ?? '') }}</textarea>
                    </div>
                     <div>
                        <label for="director_greeting_slogan_en" class="block text-sm font-medium text-gray-700">Slogan (Teks dengan tanda kutip)</label>
                        <input type="text" name="director_greeting_slogan_en" id="director_greeting_slogan_en" value="{{ old('director_greeting_slogan_en', $settings['director_greeting_slogan_en'] ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="director_image" class="block text-sm font-medium text-gray-700">Foto Direktur</label>
                        <input type="file" name="director_image" id="director_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @if(isset($settings['director_image']))
                            <img src="{{ asset('storage/' . $settings['director_image']) }}" alt="Foto Direktur" class="mt-2 h-24 w-auto rounded">
                        @endif
                    </div>
                </div>
            </fieldset>

            {{-- Link Sosial Media yang muncul di Hero Section --}}
            <fieldset class="border-t pt-6">
                 <legend class="text-xl font-semibold text-gray-800 px-2">Link Sosial Media (Hero Section)</legend>
                 <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
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
            </fieldset>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection