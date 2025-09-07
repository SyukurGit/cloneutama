@extends('layouts.admin')

@section('title', 'Manajemen Informasi')
@section('header', 'Manajemen Informasi')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.information.create') }}" class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            <span>Tambah Informasi</span>
        </a>
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
    </div>

    {{-- ====================================================== --}}
    {{-- ============ BAGIAN BARU UNTUK TOMBOL SWITCH ============ --}}
    {{-- ====================================================== --}}
    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-3">Pengaturan Tampilan Seksi</h3>
        <div x-data="{ enabled: {{ $isSectionEnabled }} }" class="flex items-center">
            <span class="text-sm font-medium text-gray-700 mr-4">Tampilkan seksi ini di halaman depan:</span>
            <form id="toggleForm" action="{{ route('admin.information.toggle') }}" method="POST" class="inline-flex">
                @csrf
                <input type="hidden" name="enabled" :value="enabled">
                <button type="button" @click="enabled = !enabled; $nextTick(() => $el.closest('form').submit())" 
                        class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors"
                        :class="enabled ? 'bg-red-600' : 'bg-gray-200'">
                    <span class="sr-only">Toggle Section Visibility</span>
                    <span :class="enabled ? 'translate-x-6' : 'translate-x-1'"
                          class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform">
                    </span>
                </button>
            </form>
            <span x-text="enabled ? 'Aktif' : 'Tidak Aktif'" class="ml-3 text-sm font-semibold" :class="enabled ? 'text-green-600' : 'text-gray-500'"></span>
        </div>
    </div>
    {{-- ====================================================== --}}
    {{-- ======================= AKHIR BAGIAN ======================= --}}
    {{-- ====================================================== --}}


    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                {{-- ... isi tabel tidak berubah ... --}}
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Label</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($informations as $info)
                        <tr>
                            <td class="px-6 py-4">
                                @if($info->thumbnail)
                                    <img src="{{ asset('storage/' . $info->thumbnail) }}" alt="Thumbnail" class="h-12 w-12 object-cover rounded-md">
                                @else
                                    <div class="h-12 w-12 bg-gray-200 rounded-md flex items-center justify-center text-xs text-gray-500">No Image</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $info->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if($info->label)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $info->label }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($info->type) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.information.edit', $info->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('admin.information.destroy', $info->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                Belum ada data informasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection