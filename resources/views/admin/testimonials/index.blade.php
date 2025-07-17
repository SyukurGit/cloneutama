@extends('layouts.admin')
@section('title', 'Manajemen Testimoni Alumni')
@section('header', 'Manajemen Testimoni Alumni')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.testimonials.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">+ Tambah Testimoni</a>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Foto</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Nama & Komentar</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testimonials as $testimonial)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <img src="{{ asset('storage/' . $testimonial->image_path) }}" alt="{{ $testimonial->name }}" class="w-16 h-16 object-cover rounded-full">
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 font-bold">{{ $testimonial->name }}</p>
                        
                        {{-- ========================================================== --}}
                        {{--              PERBAIKAN TAMPILAN KOMENTAR               --}}
                        {{-- ========================================================== --}}
                        <p class="text-gray-600 italic">"{{ Str::limit(strip_tags($testimonial->quote), 80) }}"</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{-- ========================================================== --}}
                        {{--          PERBAIKAN KOLOM AKSI (EDIT & HAPUS)           --}}
                        {{-- ========================================================== --}}
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus testimoni ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-10">Belum ada testimoni.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection