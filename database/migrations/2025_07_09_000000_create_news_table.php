<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            // Kolom yang sudah disederhanakan
            $table->string('title'); // Hanya satu judul (sebelumnya title_en)
            $table->longText('content'); // Menjadi longText untuk menampung HTML dari editor
            $table->string('image')->nullable(); // Gambar utama, boleh kosong

            // Kolom Profesional Baru
            $table->string('author')->default('Admin'); // Nama peng-upload/penulis
            $table->string('category')->nullable(); // Kategori berita
            $table->string('status')->default('Posted'); // Status, default 'Posted'

            // Relasi Opsional ke Program Studi
            $table->foreignId('study_program_id')->nullable()->constrained('study_programs')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};