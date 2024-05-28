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
        Schema::create('pelunasan_pembelians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pembelian_id');
            $table->bigInteger('nominal_pembayaran')->nullable();


            $table->foreign('pembelian_id')->references('id')->on('transaksi_pembelians')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelunasan_pembelians');
    }
};
