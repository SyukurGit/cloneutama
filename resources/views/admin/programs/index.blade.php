@extends('layouts.admin')

@section('title', 'Manajemen Program Studi')
@section('header', 'Manajemen Program Studi')

@section('content')
<div class="container mx-auto">
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex justify-between items-center border-b">
            <h2 class="text-xl font-bold text-gray-800">Daftar Program Studi</h2>
            <a href="{{ route('admin.program-studi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                + Tambah Program Studi
            </a>
        </div>
        
        {{-- Tabel untuk Setiap Jenjang --}}
        @foreach (['S3' => 'Doctoral Degree', 'S2' => 'Master\'s Degree'] as $level => $title)
            @if(isset($programs[$level]) && $programs[$level]->isNotEmpty())
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 px-6">{{ $title }}</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full mt-2">
                        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">Nama Program Studi</th>
                                <th class="py-3 px-6 text-left">Akreditasi</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($programs[$level] as $program)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $program->name }}</td>
                                    <td class="py-3 px-6 text-left">{{ $program->accreditation }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center gap-2">
                                            <a href="{{ route('admin.program-studi.edit', $program) }}" class="bg-yellow-200 hover:bg-yellow-300 text-yellow-800 font-bold py-1 px-3 rounded-full text-xs">Edit</a>
                                            <form action="{{ route('admin.program-studi.destroy', $program) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program studi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-200 hover:bg-red-300 text-red-600 font-bold py-1 px-3 rounded-full text-xs">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection