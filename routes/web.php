<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan kita gunakan
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\HomepageSettingController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\LeadershipController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TrixAttachmentController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Rute Publik (Untuk Pengunjung Website)
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', [LocalizationController::class, 'setLang'])->name('lang.switch');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/berita/{news:slug}', [DashboardController::class, 'show'])->name('news.show'); // <-- perubahan slug

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
    Route::resource('program-studi', StudyProgramController::class);

    // 5. Pengaturan Sambutan Direktur
    Route::get('/pengaturan-sambutan', [SiteSettingController::class, 'index'])->name('director_settings.index');
    Route::post('/pengaturan-sambutan', [SiteSettingController::class, 'update'])->name('director_settings.update');

    // 6. Manajemen Tim Pimpinan (CRUD)
    Route::resource('pimpinan', LeadershipController::class);

    // 7. Manajemen Testimoni (CRUD)
    Route::resource('testimonials', TestimonialController::class);

    // 8. MANAJEMEN AKUN (HANYA UNTUK SUPER ADMIN)
    Route::middleware('can:isSuperAdmin')->group(function () {
        Route::resource('users', UserManagementController::class)->except(['show']);
        Route::put('users/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('users.reset-password');
    });

    // 9. Upload gambar dari TinyMCE
    Route::post('/upload-image', [NewsController::class, 'uploadImage'])->name('image.upload');

    // 10. Upload dan hapus file dari Trix Editor
    Route::post('trix/attachment', [TrixAttachmentController::class, 'store'])->name('trix.attachment.store');
    Route::delete('trix/attachment', [TrixAttachmentController::class, 'destroy'])->name('trix.attachment.destroy');

});
