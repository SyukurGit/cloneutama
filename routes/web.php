<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan kita gunakan
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\HomepageSettingController; // <-- INI YANG KURANG

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
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // 1. Dashboard Utama
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 2. Berita (CRUD)
    Route::resource('berita', NewsController::class);

    // 3. Pengaturan Halaman Depan
    Route::get('/pengaturan-halaman', [HomepageSettingController::class, 'index'])->name('homepage_settings.index');
    Route::post('/pengaturan-halaman', [HomepageSettingController::class, 'update'])->name('homepage_settings.update');

});