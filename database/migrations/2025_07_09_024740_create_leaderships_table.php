<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_leaderships_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('image_path'); // Untuk menyimpan path gambar
            $table->string('social_link')->nullable(); // Link sosmed, boleh kosong
            $table->integer('order')->default(0); // Untuk urutan tampilan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderships');
    }
};
