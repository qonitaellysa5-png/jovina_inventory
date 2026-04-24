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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('jenis', 50)->nullable();
            $table->string('satuan', 30)->nullable();
            $table->integer('stok_unit')->default(0);
            $table->integer('stok_dapat_dijual')->default(0);
            $table->unsignedBigInteger('gudang_id')->nullable();
            $table->unsignedBigInteger('id_supplier')->nullable();
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->timestamps();

            $table->foreign('id_supplier')->references('id_supplier')->on('supplier');
            $table->foreign('id_admin')->references('id_admin')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};