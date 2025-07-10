@extends('layouts.admin')
@section('title', 'Tambah Testimoni Baru')
@section('header', 'Tambah Testimoni Baru')

@section('content')
<div class="container mx-auto">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Pengomentar</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- ========================================================== --}}
            {{--     BAGIAN INI DIUBAH KEMBALI MENJADI TEXTAREA BIASA     --}}
            {{-- ========================================================== --}}
            <div>
                <label for="quote" class="block text-sm font-medium text-gray-700">Isi Komentar</label>
                <textarea name="quote" id="quote" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('quote') }}</textarea>
            </div>
            
            <div>
                <label for="link" class="block text-sm font-medium text-gray-700">Link (Opsional)</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}" placeholder="https://example.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Foto Pengomentar</label>
                <input type="file" name="image" id="image" required class="mt-1 block w-full">
            </div>
        </div>
        <div class="flex justify-end pt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection