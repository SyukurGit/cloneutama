<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Tambahkan kolom slug setelah kolom title
            $table->string('slug')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Hapus kolom slug jika migrasi di-rollback
            $table->dropColumn('slug');
        });
    }
};