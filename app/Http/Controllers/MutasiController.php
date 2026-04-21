<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutasiController extends Controller
{
    public function index()
    {
        $rows = DB::table('mutasi')
            ->join('barang', 'mutasi.barang_id', '=', 'barang.id')
            ->join('gudang as ga', 'mutasi.gudang_asal_id', '=', 'ga.id')
            ->join('gudang as gt', 'mutasi.gudang_tujuan_id', '=', 'gt.id')
            ->select(
                'mutasi.id as mutasi_id',
                'barang.kode as kode',
                'barang.nama as nama',
                'ga.nama as gudang_asal',
                'gt.nama as gudang_tujuan',
                'mutasi.tanggal_transaksi as tanggal_transaksi',
                'mutasi.jumlah as jumlah',
                'mutasi.status as status',
                'mutasi.keterangan as keterangan'
            )
            ->orderByDesc('mutasi.id')
            ->get();

        $gudangs = DB::table('gudang')->select('id','nama')->orderBy('nama')->get();

        return view('mutasi.index', compact('rows', 'gudangs'));
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

    private function getOrCreateBarangId(array $data, int $gudang_asal_id): int
    {
        $barang = DB::table('barang')->where('kode', $data['kode_barang'])->first();
        if ($barang) return (int) $barang->id;

        return (int) DB::table('barang')->insertGetId([
            'kode'       => $data['kode_barang'],
            'nama'       => $data['nama_barang'],
            'jenis'      => $data['jenis_barang'] ?? 'Persediaan',
            'satuan'     => $data['satuan_barang'] ?? 'pcs',
            'gudang_id'  => $gudang_asal_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_barang'         => ['required','string','max:100'],
            'nama_barang'         => ['required','string','max:255'],

           
            'jenis_barang'        => ['nullable','string','max:100'],
            'satuan_barang'       => ['nullable','string','max:50'],

            'gudang_asal_nama'    => ['required','string','max:100'],
            'gudang_tujuan_nama'  => ['required','string','max:100'],

            'jumlah'              => ['required','integer','min:1'],
            'tanggal_transaksi'   => ['required','date'],

            'status'              => ['required','string','max:50'],
            'keterangan'          => ['nullable','string','max:255'],
        ]);

        $gudang_asal_id   = $this->getOrCreateGudangId($data['gudang_asal_nama']);
        $gudang_tujuan_id = $this->getOrCreateGudangId($data['gudang_tujuan_nama']);

        $barang_id = $this->getOrCreateBarangId($data, $gudang_asal_id);

        DB::table('mutasi')->insert([
            'barang_id'          => $barang_id,
            'gudang_asal_id'     => $gudang_asal_id,
            'gudang_tujuan_id'   => $gudang_tujuan_id,
            'tanggal_transaksi'  => $data['tanggal_transaksi'],
            'jumlah'             => $data['jumlah'],
            'status'             => $data['status'],
            'keterangan'         => $data['keterangan'] ?? null,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return redirect()->route('mutasi')->with('success_add', true);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'kode_barang'         => ['required','string','max:100'],
            'nama_barang'         => ['required','string','max:255'],
            'jenis_barang'        => ['nullable','string','max:100'],
            'satuan_barang'       => ['nullable','string','max:50'],

            'gudang_asal_nama'    => ['required','string','max:100'],
            'gudang_tujuan_nama'  => ['required','string','max:100'],

            'jumlah'              => ['required','integer','min:1'],
            'tanggal_transaksi'   => ['required','date'],

            'status'              => ['required','string','max:50'],
            'keterangan'          => ['nullable','string','max:255'],
        ]);

        $gudang_asal_id   = $this->getOrCreateGudangId($data['gudang_asal_nama']);
        $gudang_tujuan_id = $this->getOrCreateGudangId($data['gudang_tujuan_nama']);

        $barang_id = $this->getOrCreateBarangId($data, $gudang_asal_id);

        DB::table('mutasi')->where('id', $id)->update([
            'barang_id'          => $barang_id,
            'gudang_asal_id'     => $gudang_asal_id,
            'gudang_tujuan_id'   => $gudang_tujuan_id,
            'tanggal_transaksi'  => $data['tanggal_transaksi'],
            'jumlah'             => $data['jumlah'],
            'status'             => $data['status'],
            'keterangan'         => $data['keterangan'] ?? null,
            'updated_at'         => now(),
        ]);

        return redirect()->route('mutasi')->with('success_update', true);
    }

    public function destroy($id)
    {
        DB::table('mutasi')->where('id', $id)->delete();
        return redirect()->route('mutasi')->with('success_delete', true);
    }
}