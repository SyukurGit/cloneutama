<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek dulu agar tidak membuat user duplikat jika seeder dijalankan lagi
        $user = DB::table('users')->where('email', 'admin@webkampus.com')->first();

        if (!$user) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@webkampus.com',
                'role' => 'superadmin',
                'password' => Hash::make('password'), // Ganti 'password' dengan sandi yang aman
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}