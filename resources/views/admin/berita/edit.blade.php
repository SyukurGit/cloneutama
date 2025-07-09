@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('header', 'Edit Berita')

@section('content')
<div class="container mx-auto">
    <form action="{{ route('admin.berita.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Kolom Utama (Editor Teks) --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
    <label for="content" class="block text-sm font-medium text-gray-700">Isi Konten</label>
    <input id="content" type="hidden" name="content" value="{{ old('content', $news->content) }}">
    <trix-editor input="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></trix-editor>
</div>
                </div>
            </div>

            {{-- Kolom Samping (Metadata & Gambar) --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium mb-4">Metadata</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700">Nama Penulis</label>
                            <input type="text" name="author" id="author" value="{{ old('author', $news->author) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Posted" @if($news->status == 'Posted') selected @endif>Posted</option>
                                <option value="Draft" @if($news->status == 'Draft') selected @endif>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium mb-4">Gambar Utama</h3>
                    <input type="file" name="image" id="image" class="block w-full text-sm">
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" class="mt-4 h-24 w-auto rounded-md">
                    @endif
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
  tinymce.init({
    selector: 'textarea#content-editor',
    plugins: 'code table lists image link fullscreen',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image link | fullscreen',
    height: 450,
    // Konfigurasi untuk upload gambar
    images_upload_url: '/admin/upload-image', // URL yang akan kita buat nanti
    automatic_uploads: true,
    file_picker_types: 'image',
  });
</script>
@endsection