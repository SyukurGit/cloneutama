@extends('layouts.admin')

@section('title', 'Tambah Fasilitas Baru')
@section('header', 'Tambah Fasilitas Baru')

@section('content')
<div class="space-y-6">
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Terjadi Kesalahan</p>
            <ul class="list-disc list-inside text-sm mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
        <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Grid 2 kolom untuk input --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">Judul Fasilitas</label>
                    <input type="text" name="title" id="title" 
                        class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm 
                               focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 sm:text-sm" 
                        value="{{ old('title') }}" required>
                </div>

                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-800 mb-2">Gambar Fasilitas</label>
                    <input type="file" name="image" id="image" 
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer 
                               bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-600">
                    <p class="mt-2 text-xs text-gray-500 italic">Rekomendasi ukuran: 800x600 px. Format: jpg, jpeg, png.</p>
                </div>
            </div>

            {{-- Tombol aksi --}}
            <div class="flex items-center space-x-4 pt-4">
                <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                    Simpan
                </button>
                <a href="{{ route('admin.facilities.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
