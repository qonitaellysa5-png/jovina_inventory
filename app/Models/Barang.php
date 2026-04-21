<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'satuan',
        'stok_unit',
        'stok_dapat_dijual',
        'gudang_id',
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}