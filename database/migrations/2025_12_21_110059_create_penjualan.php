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
        Schema::create('penjualan', function (Blueprint $table) {
    $table->id('id_penjualan');

    $table->unsignedBigInteger('id_barang');
    $table->unsignedBigInteger('id_pelanggan');
    $table->unsignedBigInteger('id_pengiriman');

    $table->integer('jumlah');
    $table->date('tanggal_penjualan');
    $table->text('keterangan')->nullable();
    $table->timestamps();

    $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
    $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->cascadeOnDelete();
    $table->foreign('id_pengiriman')->references('id_pengiriman')->on('pengiriman')->cascadeOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};