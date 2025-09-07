@extends('layouts.admin')

@section('title', 'Edit Informasi')
@section('header', 'Edit Informasi')

@section('content')
<div x-data="{ type: '{{ old('type', $information->type) }}' }" class="space-y-6">
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

    <form action="{{ route('admin.information.update', $information->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Informasi</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('title', $information->title) }}" required>
                </div>
                <div>
                    <label for="label" class="block text-sm font-medium text-gray-700 mb-1">Label/Badge (Opsional) "Contoh: Announcement, Brochure, dll "</label>
                    <input type="text" name="label" id="label" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('label', $information->label) }}" placeholder="Contoh: Announcement, Brochure">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Saat Ini</label>
                    @if($information->thumbnail)
                        <img src="{{ asset('storage/' . $information->thumbnail) }}" class="h-20 w-auto rounded-md object-cover">
                    @else
                        <p class="text-sm text-gray-500">Tidak ada thumbnail.</p>
                    @endif
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mt-2 mb-1">Ganti Thumbnail (Opsional)</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Sumber</label>
                    <select x-model="type" name="type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="file" @selected(old('type', $information->type) == 'file')>Upload File</option>
                        <option value="link" @selected(old('type', $information->type) == 'link')>Link Eksternal</option>
                    </select>
                </div>

                <div x-show="type === 'file'" class="md:col-span-2">
                    <label for="file_path" class="block text-sm font-medium text-gray-700 mb-1">Upload File Baru (Opsional)</label>
                    @if($information->file_path)
                        <p class="text-sm text-gray-500 mb-1">File saat ini: <a href="{{ asset('storage/' . $information->file_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></p>
                    @endif
                    <input type="file" name="file_path" id="file_path" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                </div>
                <div x-show="type === 'link'" class="md:col-span-2">
                    <label for="external_link" class="block text-sm font-medium text-gray-700 mb-1">URL Link Eksternal</label>
                    <input type="url" name="external_link" id="external_link" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('external_link', $information->external_link) }}" placeholder="https:// ...">
                </div>
            </div>
            <div class="flex items-center space-x-4 mt-6">
                <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg">Update</button>
                <a href="{{ route('admin.information.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection