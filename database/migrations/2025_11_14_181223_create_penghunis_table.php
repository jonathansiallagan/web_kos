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
        Schema::create('penghunis', function (Blueprint $table) {
        $table->id();

        $table->string('nama');
        $table->string('email')->nullable();
        $table->string('no_telepon')->nullable();

        $table->foreignId('kamar_id')
              ->nullable()
              ->constrained('kamars')
              ->nullOnDelete();

        $table->date('tanggal_masuk')->nullable();
        $table->date('tanggal_keluar')->nullable();

        $table->string('status')->default('Aktif'); 
        // Aktif / Pending / Keluar

        $table->string('foto')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghunis');
    }
};
