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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->integer('id_transaksi')->primary();
            $table->integer('id_pesanan');
            $table->integer('id_meja');
            $table->integer('total');
            $table->integer('bayar');
            $table->timestamps();
            
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanans');
            $table->foreign('id_meja')->references('id')->on('mejas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
