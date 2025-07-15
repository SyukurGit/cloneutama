<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\StudyProgram;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat tag default
        Tag::updateOrCreate(
            ['slug' => 'pascasarjana'],
            ['name_id' => '#pascasarjana', 'name_en' => '#postgraduate']
        );

        // 2. Ambil semua prodi dan jadikan tag
        $studyPrograms = StudyProgram::all();
        foreach ($studyPrograms as $program) {
            Tag::updateOrCreate(
                ['slug' => Str::slug($program->name)],
                [
                    'name_id' => $program->name, // Asumsi nama prodi sudah dalam format yg benar
                    'name_en' => $program->name  // Nama Inggris sama dengan nama Indonesia
                ]
            );
        }
    }
}