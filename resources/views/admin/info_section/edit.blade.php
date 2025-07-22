@extends('layouts.admin')
@section('title', 'Atur Info Section')
@section('header', 'Pengaturan Info Section')

@section('content')
<div class="container mx-auto px-4 py-6">
    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-800 p-4 rounded-lg mb-6 shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.info_section.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">Edit Konten</h2>
                <div x-data="{ enabled: {{ $section->is_active ? 'true' : 'false' }} }">
                    <label for="is_active" class="flex items-center cursor-pointer">
                        <span class="mr-3 text-sm font-medium text-white">Tampilkan Section</span>
                        <div class="relative">
                            <input id="is_active" name="is_active" type="checkbox" class="sr-only" x-model="enabled">
                            <div class="block bg-gray-200 w-14 h-8 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform" :class="{ 'translate-x-6 !bg-green-400': enabled }"></div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $section->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="slogan" class="block text-sm font-medium text-gray-700">Slogan</label>
                    <input type="text" name="slogan" id="slogan" value="{{ old('slogan', $section->slogan) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Isi Konten</label>
                    <textarea name="content" id="content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('content', $section->content) }}</textarea>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t">
                <div class="flex justify-end">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-6 rounded-lg">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection