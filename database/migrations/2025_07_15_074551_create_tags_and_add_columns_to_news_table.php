<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Menambah kolom tanggal publikasi ke tabel news
        Schema::table('news', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->after('status');
        });

        // 2. Membuat tabel untuk menyimpan tags
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name_id'); // Nama Tag Bahasa Indonesia
            $table->string('name_en'); // Nama Tag Bahasa Inggris
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 3. Membuat tabel penghubung (pivot table)
        Schema::create('news_tag', function (Blueprint $table) {
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->primary(['news_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_tag');
        Schema::dropIfExists('tags');
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
    }
};