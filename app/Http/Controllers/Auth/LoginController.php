<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman formulir login.
     */
    public function showLoginForm()
    {
        // Jika pengguna sudah login, langsung arahkan ke dasbor admin yang baru
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('loginadmin');
    }

    /**
     * Menangani permintaan login dari formulir.
     */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validasi input dari form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba untuk melakukan autentikasi
        if (Auth::attempt($credentials)) {
            // Jika berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();

            // ==========================================================
            // ===        PERUBAHAN UTAMA ADA DI BARIS INI            ===
            // ==========================================================
            // Arahkan ke halaman dashboard admin yang baru, bukan ke 'admin.input'
            return redirect()->intended(route('admin.dashboard'));
        }

        // 3. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menangani permintaan logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman login setelah logout
        return redirect('/login');
    }
}