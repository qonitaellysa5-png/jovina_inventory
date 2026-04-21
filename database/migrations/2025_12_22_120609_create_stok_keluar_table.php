<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stok_keluars', function (Blueprint $table) {
            $table->id();

            // relasi ke barang.id_barang (bukan id)
            $table->unsignedBigInteger('id_barang');

            $table->string('jumlah_unit'); // contoh: "3 Helai"
            $table->date('tanggal');
            $table->string('gudang', 100)->nullable();

            $table->timestamps();

            $table->foreign('id_barang')
                ->references('id_barang')
                ->on('barang')
                ->cascadeOnDelete();

            $table->index('tanggal');
            $table->index('gudang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_keluars');
    }
};
