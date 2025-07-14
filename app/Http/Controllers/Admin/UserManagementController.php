<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    // Menampilkan halaman utama manajemen akun
    public function index()
    {
        $superAdmins = User::where('role', 'superadmin')->get();
        $adminBeritas = User::where('role', 'admin_berita')->get();
        return view('admin.users.index', compact('superAdmins', 'adminBeritas'));
    }

    // Menampilkan form untuk membuat admin berita baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan admin berita baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin_berita', // Otomatis set role
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin Berita berhasil ditambahkan.');
    }

    // Menampilkan form edit admin berita
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Mengupdate data admin berita
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.users.index')->with('success', 'Data Admin Berita berhasil diperbarui.');
    }

    // Menghapus admin berita
    public function destroy(User $user)
    {
        // Pencegahan agar super admin tidak bisa menghapus dirinya sendiri dari daftar ini
        if ($user->role == 'superadmin') {
            return back()->with('error', 'Super Admin tidak bisa dihapus.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Admin Berita berhasil dihapus.');
    }

    // Mereset password admin berita
    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Password untuk ' . $user->name . ' berhasil direset.');
    }
}