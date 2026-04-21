<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\ConcerToModel;

class BarangImport implements ToModel
{
    public function model(array $row)
    {
        return new Barang([
            'kode_barang' => $row[0],
            'nama_barang' => $row[1],
            'jenis_barang' => $row[2],
            'satuan' => $row[3],
            'stok' => $row[4],
            'gudang' => $row[5],
        ]);
    }
}