@extends('layouts.admin')
@section('title', 'Edit Testimoni')
@section('header', 'Edit Testimoni')

@section('content')
<div class="container mx-auto">
    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Pengomentar</label>
                <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            
            {{-- ========================================================== --}}
            {{--              BAGIAN YANG SUDAH DIPERBAIKI                --}}
            {{-- ========================================================== --}}
            <div>
                <label for="quote" class="block text-sm font-medium text-gray-700">Isi Komentar</label>
                <input id="quote" type="hidden" name="quote" value="{{ old('quote', $testimonial->quote) }}">
                <trix-editor input="quote" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></trix-editor>
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

{{-- Skrip Trix Anda sudah benar dan bisa diletakkan di sini --}}
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
</script>
@endpush