<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_xx_xx_xxxxxx_create_information_table.php

public function up(): void
{
    Schema::create('information', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('label')->nullable(); // Label/Badge, boleh kosong
        $table->string('thumbnail')->nullable(); // Gambar thumbnail, boleh kosong
        $table->string('type'); // Tipe: 'file' atau 'link'
        $table->string('file_path')->nullable(); // Untuk menyimpan path file yang di-upload
        $table->text('external_link')->nullable(); // Untuk menyimpan link eksternal
        $table->timestamps();
    });
}
};
