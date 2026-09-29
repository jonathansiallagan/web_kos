<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('no_kamar');
            $table->string('tipe_kamar');
            $table->decimal('harga_perbulan', 10, 2);
            $table->string('ukuran');
            $table->text('fasilitas')->nullable();
            $table->string('status')->default('Tersedia'); // 'Tersedia' atau 'Terisi'
            $table->string('foto')->nullable();
            
            // KUNCI PENTING: Link ke tabel users (penghuni)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};