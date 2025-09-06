@extends('layouts.admin')

@section('title', 'Manajemen Fasilitas')
@section('header', 'Manajemen Fasilitas')

@section('content')
<div class="space-y-6">

    <div class="flex justify-between items-center">
        <a href="{{ route('admin.facilities.create') }}" class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>
            <span>Tambah Fasilitas</span>
        </a>
        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Fasilitas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($facilities as $facility)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $facility->image_path) }}" alt="{{ $facility->title }}" class="h-16 w-24 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $facility->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                Belum ada data fasilitas yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Script untuk menghilangkan notifikasi setelah beberapa detik
    const alert = document.getElementById('success-alert');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 3000); // 3 detik
    }
</script>
@endsection