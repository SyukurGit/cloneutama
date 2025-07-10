@extends('layouts.admin')

@section('title', 'Tulis Berita Baru')
@section('header', 'Tulis Berita Baru Bahasa English')

@section('content')
<div class="container mx-auto p-4">
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Kolom Utama (Editor Teks) --}}
            <div class="lg:col-span-2 bg-gradient-to-br from-white to-gray-50 p-8 rounded-xl shadow-lg border border-gray-100">
                <div class="space-y-8">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">Judul Berita</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-white" required placeholder="Masukkan judul berita yang menarik...">
                    </div>
                    
                    {{-- Gambar Utama dipindah ke bawah judul --}}
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-800 mb-2">Gambar Utama Berita</label>
                        <div class="relative">
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                            <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (MAX. 5MB)</p>
                                </div>
                            </label>
                        </div>
                        <div id="image-preview" class="mt-4 hidden">
                            <img id="preview-img" class="w-full h-48 object-cover rounded-lg shadow-md" alt="Preview">
                            <button type="button" onclick="removeImage()" class="mt-2 text-red-500 hover:text-red-700 text-sm font-medium">Hapus Gambar</button>
                        </div>
                    </div>
                    
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-800 mb-2">Isi Konten</label>
                        <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                        {{-- Editor diperbesar ke bawah --}}
                        <trix-editor input="content" class="w-full border-2 border-gray-200 rounded-lg shadow-sm min-h-[600px] bg-white focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition-all duration-200"></trix-editor>
                    </div>
                </div>
            </div>

            {{-- Kolom Samping (Metadata) --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Metadata
                    </h3>
                    <div class="space-y-5">
                        <div>
                            <label for="author" class="block text-sm font-semibold text-gray-800 mb-2">Nama Penulis</label>
                            <input type="text" name="author" id="author" value="{{ old('author', 'Admin') }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-white" required>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-800 mb-2">Status</label>
                            <select name="status" id="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-white">
                                <option value="Posted">Posted</option>
                                {{-- <option value="Draft">Draft</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-end gap-4">
                    {{-- <button type="submit" name="action" value="draft" class="text-sm text-gray-700 hover:text-black">Simpan sebagai Draft</button> --}}
                    <button type="submit" name="action" value="publish" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Publikasikan
                    </button>
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

@push('scripts')
<script>
    // URL untuk upload dan hapus
    const trixUploadUrl = "{{ route('admin.trix.attachment.store') }}";
    const trixRemoveUrl = "{{ route('admin.trix.attachment.destroy') }}";
    // CSRF Token
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    addEventListener("trix-attachment-add", function(event) {
        if (event.attachment.file) {
            uploadTrixFile(event.attachment);
        }
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
                attachment.setAttributes({
                    url: response.url,
                    href: response.url
                });
            } else {
                 attachment.remove();
                 alert('Gagal mengunggah gambar. Pastikan file adalah gambar dan ukurannya tidak terlalu besar.');
            }
        }

        xhr.send(formData);
    }

    function deleteTrixFile(attachment) {
        fetch(trixRemoveUrl, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ 'url': attachment.attachment.attributes.values.url })
        });
    }

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
</script>
@endpush
@endsection