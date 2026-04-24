<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table ='admin';
    protected $primaryKey ='id_admin';
    public $timestamps = false;
    protected $fillable = [
        'nama_admin',
        'email',
        'username',
        'password',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_admin');
    }

}