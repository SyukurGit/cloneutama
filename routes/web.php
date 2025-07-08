<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\SiteSettingController;

// --- ROUTE PUBLIK ---
Route::get('lang/{locale}', [LocalizationController::class, 'setLang'])->name('lang.switch');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// INI ROUTE YANG HILANG DAN PERLU DITAMBAHKAN KEMBALI
// URL: /berita/{id} -> Nama Route: news.show
Route::get('/berita/{news}', [DashboardController::class, 'show'])->name('news.show');


// --- ROUTE AUTENTIKASI ---
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});


// --- ROUTE ADMIN YANG DILINDUNGI ---
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // URL: /admin/input -> Nama Route: admin.input
    Route::get('/input', function () {
        return view('admininput');
    })->name('input');

    // URL: /admin/news -> Nama Route: admin.news.index
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');

    // URL: /admin/news/store -> Nama Route: admin.news.store
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');

    // URL: /admin/news/{id}/delete -> Nama Route: admin.news.destroy
    Route::post('/news/{news}/delete', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::get('/settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
});

