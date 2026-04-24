<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    \App\Models\Gudang::create(['nama' => 'Gudang Utama']);
    \App\Models\Gudang::create(['nama' => 'Gudang Cabang']);
}
}
