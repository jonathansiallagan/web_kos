<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('bulan_tahun'); // Misal: 2025-11-01 (untuk November 2025)
            $table->string('status_pembayaran')->default('Belum Bayar'); // 'Belum Bayar' atau 'Lunas'
            $table->decimal('jumlah_bayar', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};