<?php

namespace App\Providers;

// Import class yang kita butuhkan
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // <-- PENTING: Untuk memeriksa keberadaan tabel
use Illuminate\Support\Facades\View;   // <-- PENTING: Untuk berbagi data ke view
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Tidak ada yang perlu diubah di sini
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cek dulu apakah tabel 'settings' sudah ada di database.
        // Ini sangat penting untuk mencegah error saat Anda menjalankan 'php artisan migrate'
        // untuk pertama kalinya, karena pada saat itu tabel 'settings' belum ada.
        if (Schema::hasTable('settings')) {
            // Ambil semua data dari tabel 'settings' dan ubah formatnya
            // menjadi array ['key' => 'value'] agar mudah diakses.
            $settings = Setting::all()->pluck('value', 'key');

            // Bagikan variabel $settings ke SEMUA view yang ada di aplikasi.
            // Sekarang, variabel $settings bisa diakses dari file .blade.php manapun.
            View::share('settings', $settings);
        }
    }
}