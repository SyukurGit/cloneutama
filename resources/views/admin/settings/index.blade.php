{{-- resources/views/admin/settings/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Pengaturan Halaman')
@section('header', 'Pengaturan Konten Halaman Utama')

@section('content')
<div class="container mx-auto">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white p-8 rounded-lg shadow-lg space-y-8">

            {{-- Bagian Sambutan Direktur --}}
            <fieldset class="border-t pt-6">
                <legend class="text-xl font-semibold text-gray-800 px-2">Sambutan Direktur (English)</legend>
                <div class="mt-4 space-y-4">
                    <div>
                        <label for="director_greeting_intro_en" class="block text-sm font-medium text-gray-700">Intro Sambutan</label>
                        <input type="text" name="director_greeting_intro_en" id="director_greeting_intro_en" value="{{ old('director_greeting_intro_en', $settings['director_greeting_intro_en'] ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="director_greeting_body_en" class="block text-sm font-medium text-gray-700">Isi Sambutan</label>
                        <textarea name="director_greeting_body_en" id="director_greeting_body_en" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('director_greeting_body_en', $settings['director_greeting_body_en'] ?? '') }}</textarea>
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

            {{-- Tambahkan fieldset lain untuk bagian lainnya, misal Key Features --}}
            <fieldset class="border-t pt-6">
                <legend class="text-xl font-semibold text-gray-800 px-2">Key Features (English)</legend>
                <div class="mt-4 space-y-4">
                    <div>
                        <label for="key_feature1_title_en" class="block text-sm font-medium text-gray-700">Judul Fitur 1 (Why Us?)</label>
                        <input type="text" name="key_feature1_title_en" id="key_feature1_title_en" value="{{ old('key_feature1_title_en', $settings['key_feature1_title_en'] ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                     <div>
                        <label for="key_feature1_text_en" class="block text-sm font-medium text-gray-700">Teks Fitur 1</label>
                        <textarea name="key_feature1_text_en" id="key_feature1_text_en" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('key_feature1_text_en', $settings['key_feature1_text_en'] ?? '') }}</textarea>
                    </div>
                    {{-- Ulangi untuk Fitur 2 dan 3 --}}
                </div>
            </fieldset>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Simpan Semua Pengaturan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection