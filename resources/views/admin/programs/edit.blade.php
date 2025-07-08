@extends('layouts.admin')

@section('title', 'Edit Program Studi')
@section('header', 'Edit Program Studi')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
        <form action="{{ route('admin.program-studi.update', $program) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT') {{-- Penting untuk proses update --}}
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Program Studi (Inggris)</label>
                <input type="text" name="name" id="name" value="{{ old('name', $program->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="level" class="block text-sm font-medium text-gray-700">Jenjang</label>
                <select name="level" id="level" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="S2" @if($program->level == 'S2') selected @endif>S2 (Master)</option>
                    <option value="S3" @if($program->level == 'S3') selected @endif>S3 (Doctoral)</option>
                </select>
            </div>

            <div>
                <label for="accreditation" class="block text-sm font-medium text-gray-700">Akreditasi</label>
                <input type="text" name="accreditation" id="accreditation" value="{{ old('accreditation', $program->accreditation) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-gray-700">Link Halaman Detail (URL)</label>
                <input type="url" name="link" id="link" value="{{ old('link', $program->link) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="https://...">
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('admin.program-studi.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection