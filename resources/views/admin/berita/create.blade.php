@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')
@section('header', 'Tambah Berita Baru')

@section('content')
<div class="container mx-auto">
    {{-- Notifikasi Error atau Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p class="font-bold">Terjadi Kesalahan</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            {{-- Input Gambar --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama (Opsional)</label>
                <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            {{-- Grid untuk input multi-bahasa --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Bahasa Indonesia</h3>
                    <div>
                        <label for="title_id" class="block text-sm font-medium text-gray-700">Judul (ID)</label>
                        <input type="text" name="title_id" id="title_id" value="{{ old('title_id') }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="content_id" class="block text-sm font-medium text-gray-700">Konten (ID)</label>
                        <textarea name="content_id" id="content_id" rows="10" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('content_id') }}</textarea>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">English</h3>
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title (EN)</label>
                        <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="content_en" class="block text-sm font-medium text-gray-700">Content (EN)</label>
                        <textarea name="content_en" id="content_en" rows="10" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('content_en') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection