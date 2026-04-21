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

            $table->foreignId('barang_id')->constrained('barang')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('gudang_asal_id')->constrained('gudang')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('gudang_tujuan_id')->constrained('gudang')
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