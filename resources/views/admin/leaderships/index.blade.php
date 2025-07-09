@extends('layouts.admin')
@section('title', 'Manajemen Pimpinan')
@section('header', 'Manajemen Tim Pimpinan')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.pimpinan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
            + Tambah Pimpinan
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Urutan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama & Jabatan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leaders as $leader)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $leader->order }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <img src="{{ asset('storage/' . $leader->image_path) }}" alt="{{ $leader->name }}" class="w-16 h-16 object-cover rounded-full">
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $leader->name }}</p>
                        <p class="text-gray-600 whitespace-no-wrap">{{ $leader->position }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <a href="{{ route('admin.pimpinan.edit', $leader->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.pimpinan.destroy', $leader->id) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-10">Belum ada data pimpinan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection