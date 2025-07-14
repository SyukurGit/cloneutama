@extends('layouts.admin')
@section('title', 'Edit Admin Berita')
@section('header', 'Edit Akun: ' . $user->name)

@section('content')
<div class="space-y-8">
    {{-- Form Edit Data --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Edit Informasi Akun</h3>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Update Informasi</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Form Reset Password --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-4">Reset Password</h3>
        <form action="{{ route('admin.users.reset-password', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection