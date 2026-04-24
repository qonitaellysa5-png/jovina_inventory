<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barang_id')->references('id')->on('barang')->onDelete('restrict')->onUpdate('cascade');

            $table->foreignId('gudang_asal_id')->constrained('gudang', 'id_gudang')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('gudang_tujuan_id')->constrained('gudang', 'id_gudang')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('tanggal_transaksi');
            $table->unsignedInteger('jumlah');
            $table->string('status', 50)->default('Mutasi');
            $table->string('keterangan', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};