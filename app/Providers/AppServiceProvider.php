<?php

namespace App\Providers;

// Import class yang kita butuhkan
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        if (Schema::hasTable('settings')) {
            // Ambil semua data dari tabel 'settings'
            $settings = Setting::all()->pluck('value', 'key');

            // Bagikan variabel $settings ke SEMUA view yang ada di aplikasi.
            View::share('settings', $settings);

            // BARIS LAMA SUDAH DIHAPUS DARI SINI
        }
    }
}