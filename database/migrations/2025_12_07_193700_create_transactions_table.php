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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Yang pesen
        $table->foreignId('package_id')->constrained()->cascadeOnDelete(); // Paket yg dipesen
        $table->date('tour_date'); // Tgl berangkat
        $table->integer('pax_count'); // Jumlah orang
        $table->decimal('total_price', 15, 2); // Total bayar
        $table->string('status')->default('pending'); // pending, waiting_approval, approved, rejected
        $table->string('payment_proof')->nullable(); // Foto bukti transfer
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
