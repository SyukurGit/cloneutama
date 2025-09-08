@extends('layouts.admin')

@section('title', 'Add Thesis Schedule')
@section('header', 'Add New Thesis Schedule')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Tambah Jadwal Thesis Baru
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Isi detail di bawah untuk menambahkan link jadwal baru.
            </p>

            <form action="{{ route('admin.thesis-schedules.store') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
<input type="text" name="url" id="url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="contoh: docs.google.com/..." required>
                </div>
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampil</label>
                    <input type="number" name="order" id="order" value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.thesis-schedules.index') }}" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Batal</a>
                    <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection