<?php

namespace App\Models;

use illuminate\Database\Eloquent\model;

class supplier extends model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    public $timestamps = false;

    protected $fillable = [
        'nama_supplier',
        'alamat_supplier',
        'no_telp'
    ];

    public function barang()
    {
        return $this->hasmany(barang::class, 'id_supplier');
    }
}