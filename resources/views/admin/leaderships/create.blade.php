@extends('layouts.admin')
@section('title', 'Tambah Pimpinan Baru')
@section('header', 'Tambah Pimpinan Baru')

@section('content')
<div class="container mx-auto">
    <form action="{{ route('admin.pimpinan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <input type="text" name="position" id="position" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="social_link" class="block text-sm font-medium text-gray-700">Link Sosial Media (Opsional)</label>
                <input type="url" name="social_link" id="social_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampil</label>
                <input type="number" name="order" id="order" value="0" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" name="image" id="image" required class="mt-1 block w-full">
            </div>
        </div>
        <div class="flex justify-end pt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection