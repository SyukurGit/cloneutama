<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\NewsPageController;
use App\Http\Controllers\Admin\InfoSectionController; 
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\ProfileController; // <-- Tambahkan ini di bagian atas
use App\Http\Controllers\ThesisSchedulePageController;




/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (Dapat Diakses Semua Pengunjung)
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', [LocalizationController::class, 'setLang'])->name('lang.switch');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/berita', [NewsPageController::class, 'index'])->name('news.index');
Route::get('/berita/{news:slug}', [DashboardController::class, 'show'])->name('news.show');
Route::view('/profile', 'profile.index')->name('profile.index');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');





Route::get('/run-scheduler', function() {
    \Illuminate\Support\Facades\Artisan::call('schedule:run');
    return 'Scheduler executed!';
});


/*
|--------------------------------------------------------------------------
| RUTE AUTENTIKASI (LOGIN & LOGOUT)
|--------------------------------------------------------------------------
*/
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    // Penambahan middleware throttle untuk Anti Brute Force
    Route::post('/login', 'login')->middleware('throttle:5,1');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| RUTE PANEL ADMIN (Dilindungi Middleware 'auth')
|--------------------------------------------------------------------------
| Semua rute di dalam grup ini memerlukan login.
| Prefix: /admin, Nama: admin.*
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // 1. Dashboard & Halaman About
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/about', [AdminDashboardController::class, 'about'])->name('about');

    // 2. Manajemen Berita (CRUD)
    Route::get('berita/trash', [NewsController::class, 'trash'])->name('berita.trash');
Route::put('berita/{id}/restore', [NewsController::class, 'restore'])->name('berita.restore');
Route::delete('berita/{id}/force-delete', [NewsController::class, 'forceDelete'])->name('berita.forceDelete');
Route::resource('berita', NewsController::class);

    // 3. Manajemen Trix Editor Attachments
    Route::post('trix/attachment', [TrixAttachmentController::class, 'store'])->name('trix.attachment.store');
    Route::delete('trix/attachment', [TrixAttachmentController::class, 'destroy'])->name('trix.attachment.destroy');
    
    // --- Rute Khusus Super Admin ---
    Route::middleware('can:isSuperAdmin')->group(function () {
        // 4. Pengaturan Halaman Depan
        Route::get('/pengaturan-halaman', [HomepageSettingController::class, 'index'])->name('homepage_settings.index');
        Route::post('/pengaturan-halaman', [HomepageSettingController::class, 'update'])->name('homepage_settings.update');

        // 5. Pengaturan Sambutan Direktur
        Route::get('/pengaturan-sambutan', [SiteSettingController::class, 'index'])->name('director_settings.index');
        Route::post('/pengaturan-sambutan', [SiteSettingController::class, 'update'])->name('director_settings.update');

        // 6. Manajemen Program Studi (CRUD)
        Route::resource('program-studi', StudyProgramController::class);

        // add update
    Route::resource('facilities', App\Http\Controllers\Admin\FacilityController::class)->except(['show']);

    //infomation 
        Route::resource('information', App\Http\Controllers\Admin\InformationController::class)->except(['show']);
         Route::post('information/toggle', [App\Http\Controllers\Admin\InformationController::class, 'toggleVisibility'])->name('information.toggle');



        // 7. Manajemen Tim Pimpinan (CRUD)
        Route::resource('pimpinan', LeadershipController::class);

        // 8. Manajemen Testimoni (CRUD)
        Route::resource('testimonials', TestimonialController::class);

        // 9. Manajemen Akun (CRUD)
        Route::resource('users', UserManagementController::class)->except(['show']);
        Route::put('users/{user}/reset-password', [UserManagementController::class, 'resetPassword'])->name('users.reset-password');

        // 10.section info
        Route::get('/info-section', [InfoSectionController::class, 'edit'])->name('info_section.edit');
Route::put('/info-section', [InfoSectionController::class, 'update'])->name('info_section.update');

        Route::get('/backup/database', [BackupController::class, 'downloadDatabase'])->name('backup.database');


        Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity_log.index');

//thesis

Route::resource('thesis-schedules', App\Http\Controllers\Admin\ThesisScheduleController::class)->names('admin.thesis-schedules');
Route::get('/thesis-schedule', [ThesisSchedulePageController::class, 'index'])->name('thesis.schedule');

        


    });
});