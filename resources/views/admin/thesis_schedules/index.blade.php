@extends('layouts.admin')

@section('title', 'Thesis Schedules')
@section('header', 'Thesis Schedules')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-bold text-gray-900">Thesis Schedules</h1>
            <p class="mt-1 text-sm text-gray-600">Daftar jadwal sidang thesis terbaru.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('admin.thesis-schedules.create') }}" 
               class="inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700">
               + Tambah
            </a>
        </div>
    </div>

    <div class="mt-6">
        <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">#</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">Judul</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700">URL</th>
                        <th class="px-4 py-3 text-right font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($schedules as $schedule)
                        @php
                            // Parsing URL untuk ambil domain + sedikit path
                            $parsed = parse_url($schedule->url);
                            $domain = $parsed['host'] ?? $schedule->url;
                            $path   = $parsed['path'] ?? '';
                            $previewUrl = $domain . \Illuminate\Support\Str::limit($path, 15);
                        @endphp
                        <tr>
                            <td class="px-4 py-3 font-semibold text-gray-800">{{ $schedule->order }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $schedule->title }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ $schedule->url }}" target="_blank" 
                                   class="text-blue-600 hover:underline">
                                   {{ $previewUrl }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.thesis-schedules.edit', $schedule) }}" 
                                   class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('admin.thesis-schedules.destroy', $schedule) }}" 
                                      method="POST" class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
