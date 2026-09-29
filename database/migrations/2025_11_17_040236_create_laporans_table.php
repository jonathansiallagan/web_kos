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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siapa yang melapor
            $table->foreignId('kamar_id')->nullable()->constrained('kamars')->onDelete('set null'); // Kamar yang rusak (bisa null jika kerusakan umum)
            $table->string('judul'); // Misal: "AC Bocor", "Keran Kamar Mandi Rusak"
            $table->text('deskripsi');
            $table->string('status')->default('Baru'); // Status: 'Baru', 'Dikerjakan', 'Selesai'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
