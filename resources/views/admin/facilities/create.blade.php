@extends('layouts.admin')

@section('title', 'Tambah Fasilitas Baru')
@section('header', 'Tambah Fasilitas Baru')

@section('content')
<div class="space-y-6">
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="font-bold">Terjadi Kesalahan</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Fasilitas</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" value="{{ old('title') }}" required>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Fasilitas</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
                    <p class="mt-1 text-sm text-gray-500">Rekomendasi ukuran: 800x600 px. Format: jpg, jpeg, png.</p>
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">
                        Simpan
                    </button>
                    <a href="{{ route('admin.facilities.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection