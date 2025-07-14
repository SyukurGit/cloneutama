<?php

// app/Http/Controllers/Admin/UserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // Otorisasi: Hanya superadmin yang bisa mengakses controller ini.
        // Gate::before() akan menangani ini secara otomatis.
        // Namun, untuk keamanan berlapis, Anda bisa menambahkan middleware eksplisit.
        // Misalnya, kita buat gate 'manage-users' yang hanya return true jika rolenya superadmin
        // $this->middleware('can:manage-users');
    }

    public function index()
    {
        // Fungsi Gate::before() sudah cukup untuk melindungi ini.
        // Jika Anda mengakses halaman ini dengan user 'admin_berita',
        // Gate::before() akan return null, dan karena tidak ada gate lain
        // yang mengizinkan, akses akan ditolak dengan 403.
        // Jika diakses oleh 'superadmin', Gate::before() return true, dan akses diberikan.

        $users = User::latest()->get();
        return view('admin.users.index', compact('users')); // <-- Anda perlu membuat view ini
    }

    // ... (method create, store, edit, update, destroy lainnya)
}