<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan kita gunakan
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
// (Nanti kita akan tambah controller lain di sini)

/*
|--------------------------------------------------------------------------
| Rute Publik (Untuk Pengunjung Website)
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', [LocalizationController::class, 'setLang'])->name('lang.switch');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/berita/{news}', [DashboardController::class, 'show'])->name('news.show');

/*
|--------------------------------------------------------------------------
| Rute Autentikasi (Untuk Login & Logout Admin)
|--------------------------------------------------------------------------
*/
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Rute Panel Admin (Dilindungi & Membutuhkan Login)
|--------------------------------------------------------------------------
|
| Semua URL di sini akan diawali dengan /admin (contoh: /admin/dashboard)
| dan nama route-nya akan diawali dengan 'admin.' (contoh: admin.dashboard)
|
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // 1. Dashboard Utama
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 2. Berita (CRUD)
    // Route::resource('berita', BeritaController::class); // Placeholder untuk nanti

    // 3. Pengaturan Halaman Depan (Hero & Key Features)
    // Route::get('/pengaturan-halaman', [PengaturanHalamanController::class, 'index'])->name('pengaturan.index');
    // Route::post('/pengaturan-halaman', [PengaturanHalamanController::class, 'update'])->name('pengaturan.update');

    // (Route untuk menu lain akan kita tambahkan di sini seiring berjalannya waktu)

});