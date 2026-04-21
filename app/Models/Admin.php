<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table ='admin';
    protected $primaryKey ='id_admin';
    public $timetamps = false;
    protected $fillable = [
        'nama_admin',
        'email',
        'username',
        'password',
    ];

    public function barang()
    {
        return $this->hasMany(barang::class, 'id_admin');
    }

}