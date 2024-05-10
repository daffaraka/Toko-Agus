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
        Schema::create('transaksi_pembelians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_pembelian');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('barang_id');
            $table->date('tanggal_pembelian');
            $table->integer('qty_brg');
            $table->bigInteger('total_pembelian');
            $table->string('jenis_pembayaran');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id_vendor')->on('vendor')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('barang_id')->references('id_barang')->on('barang')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
