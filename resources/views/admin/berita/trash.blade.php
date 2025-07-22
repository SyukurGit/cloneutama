@extends('layouts.admin')
@section('title', 'Tong Sampah Berita')
@section('header', 'Berita yang Dihapus')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center text-sm font-semibold text-red-600 hover:text-red-800">
                &larr; Kembali ke Daftar Berita
            </a>
            <p class="text-sm text-gray-500 mt-1">Berita di sini akan dihapus permanen setelah 48 jam.</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Dihapus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($trashedItems as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">{{ $item->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $item->deleted_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex items-center gap-4">
                                <form action="{{ route('admin.berita.restore', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:text-green-900">Pulihkan</button>
                                </form>
                                <form action="{{ route('admin.berita.forceDelete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini secara PERMANEN?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus Permanen</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-12 text-gray-500">Tong sampah kosong.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-8">{{ $trashedItems->links() }}</div>
</div>
@endsection