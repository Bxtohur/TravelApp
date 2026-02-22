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
    Schema::create('packages', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Paket (misal: DIENG WONOSOBO)
        $table->string('slug'); // Buat link cantik (dieng-wonosobo)
        $table->string('image')->nullable(); // Foto Cover
        $table->decimal('price', 15, 2); // Harga per pax
        $table->text('facilities'); // List fasilitas (simpan sbg text panjang)
        $table->text('destinations'); // List destinasi
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
