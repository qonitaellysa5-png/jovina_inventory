<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    // ✅ FIX: pakai nama tabel yang benar di DB kamu
    protected $table = 'stok_masuk';

    protected $fillable = [
        'barang_id',
        'gudang_id',
        'tanggal',
        'jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}