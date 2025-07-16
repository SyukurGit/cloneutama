@extends('layouts.admin')

@section('title', 'Tulis Berita Baru')
@section('header', 'Tulis Berita Baru')

@section('content')
<div class="container mx-auto p-4">
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Kolom Utama (Kiri) --}}
            <div class="lg:col-span-2 bg-gradient-to-br from-white to-gray-50 p-8 rounded-xl shadow-lg border border-gray-100">
                <div class="space-y-8">
                    {{-- Judul Berita --}}
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">Judul Berita</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-white" required placeholder="Masukkan judul berita yang menarik...">
                    </div>
                    
                    {{-- Gambar Utama --}}
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-800 mb-2">Gambar Utama (Opsional)</label>
                        <div class="relative">
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                            <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500">Jika kosong, gambar default akan digunakan.</p>
                                </div>
                            </label>
                        </div>
                        <div id="image-preview" class="mt-4 hidden">
                            <img id="preview-img" class="w-full h-48 object-cover rounded-lg shadow-md" alt="Preview">
                            <button type="button" onclick="removeImage()" class="mt-2 text-red-500 hover:text-red-700 text-sm font-medium">Hapus Gambar</button>
                        </div>
                    </div>
                    
                    {{-- Isi Konten --}}
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-800 mb-2">Isi Konten</label>
                        <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                        <trix-editor input="content" class="w-full border-2 border-gray-200 rounded-lg shadow-sm min-h-[600px] bg-white focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-all duration-200"></trix-editor>
                    </div>
                </div>
            </div>

            {{-- Kolom Samping (Kanan) --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- KOTAK PUBLIKASI --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                        <i class="fas fa-paper-plane mr-2 text-blue-600"></i> Publikasi
                    </h3>
                    <div class="space-y-5">
                        <div>
                            <label for="author" class="block text-sm font-semibold text-gray-800 mb-2">Nama Penulis</label>
                            <input type="text" name="author" id="author" value="{{ old('author', Auth::user()->name) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white" required>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-800 mb-2">Status</label>
                            <select name="status" id="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white">
                                <option value="Posted">Posted</option>
                            </select>
                        </div>
                        <div>
                            <label for="published_at" class="block text-sm font-semibold text-gray-800 mb-2">Tanggal Publikasi</label>
                            <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', now()->toDateTimeLocalString()) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 bg-white">
                        </div>
                    </div>
                </div>
                
                {{-- KOTAK KATEGORI --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                        <i class="fas fa-tags mr-2 text-green-600"></i> Kategori Prodi
                    </h3>
                    <div class="space-y-2 max-h-60 overflow-y-auto pr-2">
                        {{-- Tag Default yang Non-aktif --}}
                        <label class="flex items-center p-2 rounded-md bg-gray-100">
                            <input type="checkbox" name="tags[]" value="{{ \App\Models\Tag::where('slug', 'pascasarjana')->first()->id }}" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" >
                            <span class="ml-3 text-sm font-medium text-gray-800">Postgraduate</span>
                        </label>
                        
                        {{-- Tag Pilihan Lainnya --}}
                        @foreach($tags as $tag)
                        <label class="flex items-center p-2 rounded-md hover:bg-gray-50">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-3 text-sm text-gray-700">{{ $tag->name_en }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                {{-- TOMBOL PUBLIKASI --}}
                <div class="flex items-center justify-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Publikasikan Berita
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Skrip untuk Trix editor & preview gambar, sudah digabungkan dan siap pakai.
    
    // Fungsi untuk preview gambar
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Fungsi untuk menghapus gambar
    function removeImage() {
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        imageInput.value = '';
        previewImg.src = '';
        preview.classList.add('hidden');
    }

    // Skrip Trix Editor
    const trixUploadUrl = "{{ route('admin.trix.attachment.store') }}";
    const trixRemoveUrl = "{{ route('admin.trix.attachment.destroy') }}";
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    addEventListener("trix-attachment-add", function(event) {
        if (event.attachment.file) { uploadTrixFile(event.attachment); }
    });

    addEventListener("trix-attachment-remove", function(event) {
        deleteTrixFile(event.attachment);
    });

    function uploadTrixFile(attachment) {
        const formData = new FormData();
        formData.append("file", attachment.file);
        
        const xhr = new XMLHttpRequest();
        xhr.open("POST", trixUploadUrl, true);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

        xhr.upload.onprogress = function(event) {
            let progress = event.loaded / event.total * 100;
            attachment.setUploadProgress(progress);
        }

        xhr.onload = function() {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                attachment.setAttributes({ url: response.url, href: response.url });
            } else {
                 attachment.remove();
                 alert('Gagal mengunggah gambar.');
            }
        }
        xhr.send(formData);
    }

    function deleteTrixFile(attachment) {
        fetch(trixRemoveUrl, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            body: JSON.stringify({ 'url': attachment.attachment.attributes.values.url })
        });
    }
</script>
@endpush
@endsection
