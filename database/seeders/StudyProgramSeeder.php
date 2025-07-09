<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Schema; // Pastikan ini ada

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mematikan sementara pengecekan relasi untuk mengizinkan truncate
        Schema::disableForeignKeyConstraints();

        // Hapus data lama agar tidak duplikat jika seeder dijalankan lagi
        StudyProgram::truncate();

        // Mengaktifkan kembali pengecekan relasi
        Schema::enableForeignKeyConstraints();

        // Data untuk S3 (Doctoral Degree)
        StudyProgram::create(['name' => 'Islamic Economics [S3]', 'level' => 'S3', 'accreditation' => 'A', 'link' => '#']);
        StudyProgram::create(['name' => 'Islamic Studies [S3]', 'level' => 'S3', 'accreditation' => 'A', 'link' => '#']);
        StudyProgram::create(['name' => 'Islamic Education [S3]', 'level' => 'S3', 'accreditation' => 'Very Good', 'link' => '#']);
        StudyProgram::create(['name' => 'Modern Fiqh [S3]', 'level' => 'S3', 'accreditation' => 'B', 'link' => '#']);

        // Data untuk S2 (Master's Degree)
        StudyProgram::create(['name' => 'Qur\'anic and Tafsir Studies [S2]', 'level' => 'S2', 'accreditation' => 'Very Good', 'link' => '#']);
        StudyProgram::create(['name' => 'Islamic Studies [S2]', 'level' => 'S2', 'accreditation' => 'B', 'link' => '#']);
        StudyProgram::create(['name' => 'Islamic Education [S2]', 'level' => 'S2', 'accreditation' => 'Very Good', 'link' => '#']);
        StudyProgram::create(['name' => 'Family Law [S2]', 'level' => 'S2', 'accreditation' => 'Very Good', 'link' => '#']);
        StudyProgram::create(['name' => 'Islamic Economics [S2]', 'level' => 'S2', 'accreditation' => 'B', 'link' => '#']);
        StudyProgram::create(['name' => 'Islamic Communication and Broadcasting [S2]', 'level' => 'S2', 'accreditation' => 'B', 'link' => '#']);
        StudyProgram::create(['name' => 'Arabic Language Education [S2]', 'level' => 'S2', 'accreditation' => 'Excellent', 'link' => '#']);
    }
}