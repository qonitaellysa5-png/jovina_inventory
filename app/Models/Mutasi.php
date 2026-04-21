<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';

    protected $fillable = [
        'barang_id',
        'gudang_asal_id',
        'gudang_tujuan_id',
        'tanggal_transaksi',
        'jumlah',
        'status',
        'keterangan',

    ];

    protected $casts = [
        'tanggal_transaksi' => 'date:Y-m-d',
        'jumlah' => 'integer',
    ];

    /* ================= RELATION ================= */

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function gudangAsal()
    {
        return $this->belongsTo(Gudang::class, 'gudang_asal_id');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'gudang_tujuan_id');
    }

}