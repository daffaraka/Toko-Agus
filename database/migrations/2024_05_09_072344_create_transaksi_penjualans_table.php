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
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_penjualan');
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('kasir');
            $table->date('tanggal_penjualan');
            $table->string('jenis_pembayaran');
            $table->bigInteger('total_penjualan')->default(0);
            $table->bigInteger('sisa_pembayaran')->default(0);
            $table->date('tanggal_jatuh_tempo');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualans');
    }
};
