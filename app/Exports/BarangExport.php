<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;

Class BarangExport implements FromCollection
{
    public function collection()
    {
        return Barang::all();
    }
}