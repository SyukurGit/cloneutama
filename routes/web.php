<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan kita gunakan
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\HomepageSettingController;
use App\Http\Controllers\Admin\StudyProgramController; // <-- INI YANG KURANG

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

    // 4. Manajemen Program Studi (CRUD)
    Route::resource('program-studi', StudyProgramController::class); // <-- TAMBAHKAN INI

    Route::get('/pengaturan-sambutan', [\App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('director_settings.index');
    Route::post('/pengaturan-sambutan', [\App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('director_settings.update');

    // 6. Manajemen Tim Pimpinan (CRUD)
    Route::resource('pimpinan', \App\Http\Controllers\Admin\LeadershipController::class);

    // 7. Manajemen Testimoni
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);

     // Route khusus untuk menangani upload gambar dari TinyMCE
    Route::post('/upload-image', [\App\Http\Controllers\Admin\NewsController::class, 'uploadImage'])->name('admin.image.upload');

    // TAMBAHKAN DUA ROUTE BARU INI:
    Route::post('trix/attachment', [\App\Http\Controllers\Admin\TrixAttachmentController::class, 'store'])->name('trix.attachment.store');
    Route::delete('trix/attachment', [\App\Http\Controllers\Admin\TrixAttachmentController::class, 'destroy'])->name('trix.attachment.destroy');
});