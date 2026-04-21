<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function index()
    {
        $rows = DB::table('retur')
            ->join('barang', 'retur.barang_id', '=', 'barang.id')
            ->join('gudang', 'retur.gudang_id', '=', 'gudang.id')
            ->select(
                'retur.id as retur_id',
                'barang.kode as kode',
                'barang.nama as nama',
                'barang.jenis as jenis',
                'barang.satuan as satuan',
                'retur.jumlah as jumlah',
                'retur.tanggal_retur as tanggal_retur',
                'retur.tanggal_masuk_retur as tanggal_masuk_retur',
                'gudang.nama as gudang'
            )
            ->orderByDesc('retur.id')
            ->get();

        $gudangs = DB::table('gudang')->select('id','nama')->orderBy('nama')->get();

        return view('retur.index', compact('rows','gudangs'));
    }

    private function getOrCreateGudangId(string $namaGudang): int
    {
        $namaGudang = trim($namaGudang);

        $g = DB::table('gudang')->where('nama', $namaGudang)->first();
        if ($g) return (int) $g->id;

        return (int) DB::table('gudang')->insertGetId([
            'nama'       => $namaGudang,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function getOrCreateBarangId(array $data, int $gudang_id): int
    {
        $barang = DB::table('barang')->where('kode', $data['kode_barang'])->first();
        if ($barang) return (int) $barang->id;

        return (int) DB::table('barang')->insertGetId([
            'kode'       => $data['kode_barang'],
            'nama'       => $data['nama_barang'],
            'jenis'      => $data['jenis_barang'],
            'satuan'     => $data['satuan_barang'],

            'gudang_id'  => $gudang_id,

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_barang'          => ['required','string','max:100'],
            'nama_barang'          => ['required','string','max:255'],
            'jenis_barang'         => ['required','string','max:100'],
            'satuan_barang'        => ['required','string','max:50'],

            'jumlah'               => ['required','integer','min:1'],
            'tanggal_retur'        => ['required','date'],
            'tanggal_masuk_retur'  => ['required','date'],

            'gudang_nama'          => ['required','string','max:100'],
        ]);

        $gudang_id = $this->getOrCreateGudangId($data['gudang_nama']);

        $barang_id = $this->getOrCreateBarangId($data, $gudang_id);

        DB::table('retur')->insert([
            'barang_id'           => $barang_id,
            'gudang_id'           => $gudang_id,
            'jumlah'              => $data['jumlah'],
            'tanggal_retur'       => $data['tanggal_retur'],
            'tanggal_masuk_retur' => $data['tanggal_masuk_retur'],
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        return redirect()->route('retur')->with('success_add', true);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kode_barang'          => ['required','string','max:100'],
            'nama_barang'          => ['required','string','max:255'],
            'jenis_barang'         => ['required','string','max:100'],
            'satuan_barang'        => ['required','string','max:50'],

            'jumlah'               => ['required','integer','min:1'],
            'tanggal_retur'        => ['required','date'],
            'tanggal_masuk_retur'  => ['required','date'],

            'gudang_nama'          => ['required','string','max:100'],
        ]);

        $gudang_id = $this->getOrCreateGudangId($data['gudang_nama']);
        $barang_id = $this->getOrCreateBarangId($data, $gudang_id);

        DB::table('retur')->where('id', $id)->update([
            'barang_id'           => $barang_id,
            'gudang_id'           => $gudang_id,
            'jumlah'              => $data['jumlah'],
            'tanggal_retur'       => $data['tanggal_retur'],
            'tanggal_masuk_retur' => $data['tanggal_masuk_retur'],
            'updated_at'          => now(),
        ]);

        return redirect()->route('retur')->with('success_update', true);
    }

    public function destroy($id)
    {
        DB::table('retur')->where('id', $id)->delete();
        return redirect()->route('retur')->with('success_delete', true);
    }
}