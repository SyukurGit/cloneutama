@extends('layouts.admin')
@section('title', 'Edit Data Pimpinan')
@section('header', 'Edit Data Pimpinan')

@section('content')
<div class="container mx-auto">
    <form action="{{ route('admin.pimpinan.update', $leader->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ $leader->name }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <input type="text" name="position" id="position" value="{{ $leader->position }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="social_link" class="block text-sm font-medium text-gray-700">Link Sosial Media (Opsional)</label>
                <input type="url" name="social_link" id="social_link" value="{{ $leader->social_link }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
             <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampil</label>
                <input type="number" name="order" id="order" value="{{ $leader->order }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Ganti Foto (Kosongkan jika tidak ingin mengubah)</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full">
                <img src="{{ asset('storage/' . $leader->image_path) }}" alt="{{ $leader->name }}" class="mt-4 h-32 w-auto rounded">
            </div>
        </div>
        <div class="flex justify-end pt-8">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Update Perubahan</button>
        </div>
    </form>
</div>
@endsection