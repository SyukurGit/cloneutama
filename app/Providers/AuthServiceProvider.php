<?php

// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User; // <-- Pastikan ini di-import

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Fungsi ini akan selalu dijalankan SEBELUM gate/policy lain.
        // Ini adalah "kunci utama" untuk superadmin.
        Gate::before(function (User $user, string $ability) {
            if ($user->role === 'superadmin') {
                return true; // <-- Langsung berikan akses dan hentikan pengecekan lain.
            }
        });

        // Anda tetap bisa mendefinisikan gate spesifik untuk role lain
        Gate::define('manage-news-only', function (User $user) {
            return $user->role === 'admin_berita';
        });

        // Gate untuk halaman yang butuh role superadmin secara eksplisit
        // (sebagai contoh, meskipun Gate::before sudah cukup)
        Gate::define('access-settings', function(User $user) {
            return $user->role === 'superadmin';

            
        });

        Gate::define('manage-news', function(User $user) {
        return in_array($user->role, ['superadmin', 'admin_berita']);
    });
    
    }
}