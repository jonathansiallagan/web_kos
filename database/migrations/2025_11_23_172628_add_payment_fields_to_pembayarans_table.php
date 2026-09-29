<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pembayarans', function (Blueprint $table) {
        $table->string('metode_pembayaran')->nullable();
        $table->datetime('tanggal_bayar')->nullable();
    });
}

public function down()
{
    Schema::table('pembayarans', function (Blueprint $table) {
        $table->dropColumn(['metode_pembayaran', 'tanggal_bayar']);
    });
}

};