<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Metode ini akan dipanggil saat Anda menjalankan `php artisan migrate`.
     */
    public function up(): void
    {
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis (primary key)
            $table->string('name'); // Untuk nama program studi
            $table->string('level'); // Untuk jenjang (S2 atau S3)
            $table->string('accreditation')->nullable(); // Untuk akreditasi, boleh kosong
            $table->string('link')->nullable(); // Untuk link detail, boleh kosong
            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Batalkan migrasi.
     * Metode ini akan dipanggil saat Anda menjalankan `php artisan migrate:rollback`.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};