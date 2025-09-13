@extends('layouts.admin')

@section('title', 'Tambah Flyer Baru')
@section('header', 'Tambah Flyer Baru')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Formulir Flyer</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Isi detail di bawah untuk menambahkan flyer baru.</p>

            @if ($errors->any())
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.flyers.store') }}" method="POST" class="mt-6 space-y-6" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Flyer</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm" required>
                    <p class="mt-2 text-sm text-gray-500">Judul ini untuk referensi Anda di panel admin.</p>
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar Flyer</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" required>
                    <p class="mt-2 text-sm text-gray-500">Rekomendasi rasio gambar 1:1 (persegi). Maks. 2MB.</p>
                </div>
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampil</label>
                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm" required>
                    <p class="mt-2 text-sm text-gray-500">Angka lebih kecil akan tampil lebih dulu.</p>
                </div>
                <div class="flex items-start">
                    <div class="flex h-5 items-center">
                        <input id="is_active" name="is_active" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500" checked>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="is_active" class="font-medium text-gray-700">Aktifkan Flyer</label>
                        <p class="text-gray-500">Hilangkan centang untuk menyembunyikan flyer ini dari halaman publik.</p>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.flyers.index') }}" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Batal</a>
                    <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700">Simpan Flyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection