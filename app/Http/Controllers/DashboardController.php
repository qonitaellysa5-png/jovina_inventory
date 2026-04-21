<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'barangMasuk' => 19,
            'barangKeluar' => 10,
            'barangMutasi' => 5,
            'barangRetur' => 8,
            'totalGudang' => 4,
            'totalStok' => 65,
            'produk' => [
                [
                'tanggal' => '02/14/2023',
                'kode' => '100051',
                'satuan' => 'Helai',
                'nama' => 'Blonde 14 - 45 cm',
                'jumlah' => 25,
                'gudang' => 'Gudang Masuk'
                ],
                [
                    'tanggal' => '02/15/2023',
                    'kode' => '100065',
                    'satuan' => 'Helai',
                    'nama' => 'Blonde 24 - 45 cm',
                    'jumlah' => 26,
                    'gudang' => 'Gudang Penjualan'
                ],
                [
                    'tanggal' => '02/16/2023',
                    'kode' => '100078',
                    'satuan' => 'Pcs',
                    'nama' => 'I Tape Natural 40',
                    'jumlah' => 27,
                    'gudang' => 'Gudang Rusak'
                ],
                [
                    'tanggal' => '02/17/2023',
                    'kode' => '100131',
                    'satuan' => 'Helai',
                    'nama' => 'I Tape Natural Jerry Curly 60',
                    'jumlah' => 28,
                    'gudang' => 'Gudang Retur'
                ],
            ],
            
        ]);
    }
}