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
            $table->unsignedBigInteger('supplier_id');
            $table->date('tanggal_pembelian');
            $table->bigInteger('total_pembelian')->default(0);
            $table->bigInteger('sisa_pembayaran')->default(0);
            $table->string('jenis_pembayaran');
            $table->date('tanggal_jatuh_tempo');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id_supplier')->on('supplier')->onDelete('cascade')->onUpdate('cascade');

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
