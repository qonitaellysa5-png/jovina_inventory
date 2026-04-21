<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mutasi', function (Blueprint $table) {
            // kalau kolom sudah ada, skip (biar aman)
            if (!Schema::hasColumn('mutasi', 'barang_id')) {
                $table->foreignId('barang_id')->after('id')->constrained('barang')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            }

            if (!Schema::hasColumn('mutasi', 'gudang_asal_id')) {
                $table->foreignId('gudang_asal_id')->after('barang_id')->constrained('gudang')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            }

            if (!Schema::hasColumn('mutasi', 'gudang_tujuan_id')) {
                $table->foreignId('gudang_tujuan_id')->after('gudang_asal_id')->constrained('gudang')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            }

            if (!Schema::hasColumn('mutasi', 'tanggal_transaksi')) {
                $table->date('tanggal_transaksi')->after('gudang_tujuan_id');
            }

            if (!Schema::hasColumn('mutasi', 'jumlah')) {
                $table->unsignedInteger('jumlah')->after('tanggal_transaksi');
            }

            if (!Schema::hasColumn('mutasi', 'status')) {
                $table->string('status', 50)->default('Mutasi')->after('jumlah');
            }

            if (!Schema::hasColumn('mutasi', 'keterangan')) {
                $table->string('keterangan', 255)->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mutasi', function (Blueprint $table) {
            // drop foreign dulu baru drop column
            if (Schema::hasColumn('mutasi', 'barang_id')) {
                $table->dropForeign(['barang_id']);
                $table->dropColumn('barang_id');
            }
            if (Schema::hasColumn('mutasi', 'gudang_asal_id')) {
                $table->dropForeign(['gudang_asal_id']);
                $table->dropColumn('gudang_asal_id');
            }
            if (Schema::hasColumn('mutasi', 'gudang_tujuan_id')) {
                $table->dropForeign(['gudang_tujuan_id']);
                $table->dropColumn('gudang_tujuan_id');
            }

            if (Schema::hasColumn('mutasi', 'tanggal_transaksi')) $table->dropColumn('tanggal_transaksi');
            if (Schema::hasColumn('mutasi', 'jumlah')) $table->dropColumn('jumlah');
            if (Schema::hasColumn('mutasi', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('mutasi', 'keterangan')) $table->dropColumn('keterangan');
        });
    }
};