@extends('layouts.admin')
@section('title', 'Edit Testimoni')
@section('header', 'Edit Testimoni')

@section('content')
<div class="container mx-auto">
    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf
        @method('PUT') {{-- PENTING: Method untuk update --}}

        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Pengomentar</label>
                <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="quote" class="block text-sm font-medium text-gray-700">Isi Komentar</label>
                <textarea name="quote" id="quote" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('quote', $testimonial->quote) }}</textarea>
            </div>
            <div>
                <label for="link" class="block text-sm font-medium text-gray-700">Link (Opsional)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $testimonial->link) }}" placeholder="https://example.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Ganti Foto (Kosongkan jika tidak diubah)</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full">
                <img src="{{ asset('storage/' . $testimonial->image_path) }}" alt="{{ $testimonial->name }}" class="mt-4 h-24 w-auto rounded-lg">
            </div>
        </div>
        <div class="flex justify-end pt-8">
            <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection