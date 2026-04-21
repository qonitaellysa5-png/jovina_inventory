<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokMasukController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = in_array($perPage, [10,25,50,100]) ? $perPage : 10;

        $tanggal = $request->query('tanggal'); 

        $q = StokMasuk::with(['barang','gudang'])->orderBy('tanggal', 'desc')->orderBy('id', 'desc');

        if ($tanggal) {
            $q->whereDate('tanggal', $tanggal);
        }

        $stokMasuks = $q->paginate($perPage)->appends($request->query());

        $gudangs = Gudang::orderBy('nama','asc')->get();

        return view('stokmasuk.index', compact('stokMasuks','gudangs','perPage','tanggal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'      => 'required|string|max:50',
            'nama'      => 'required|string|max:255',
            'jenis'     => 'required|string|max:50',
            'satuan'    => 'required|string|max:30',
            'jumlah'    => 'required|integer|min:1',
            'tanggal'   => 'required|date',
            'gudang_id' => 'required|exists:gudang,id',
        ]);

        DB::transaction(function () use ($validated) {
            // cari / buat barang by kode
            $barang = Barang::where('kode', $validated['kode'])->first();

            if (!$barang) {
                $barang = Barang::create([
                    'kode' => $validated['kode'],
                    'nama' => $validated['nama'],
                    'jenis' => $validated['jenis'],
                    'satuan' => $validated['satuan'],
                    'stok_unit' => 0,
                    'stok_dapat_dijual' => 0,
                    'gudang_id' => $validated['gudang_id'],
                ]);
            } else {
                // update master barang + gudang aktif
                $barang->update([
                    'nama' => $validated['nama'],
                    'jenis' => $validated['jenis'],
                    'satuan' => $validated['satuan'],
                    'gudang_id' => $validated['gudang_id'],
                ]);
            }

            // simpan stok masuk
            StokMasuk::create([
                'barang_id' => $barang->id,
                'gudang_id' => $validated['gudang_id'],
                'jumlah' => $validated['jumlah'],
                'tanggal' => $validated['tanggal'],
            ]);

            // update stok barang 
            $barang->increment('stok_unit', (int)$validated['jumlah']);
            $barang->increment('stok_dapat_dijual', (int)$validated['jumlah']);
        });

        return redirect()->route('stok-masuk', request()->query())
            ->with('toast', ['type'=>'success','title'=>'Berhasil!','message'=>'Data stok masuk berhasil ditambahkan!']);
    }

    public function update(Request $request, StokMasuk $stokMasuk)
    {
        $validated = $request->validate([
            'kode'      => 'required|string|max:50',
            'nama'      => 'required|string|max:255',
            'jenis'     => 'required|string|max:50',
            'satuan'    => 'required|string|max:30',
            'jumlah'    => 'required|integer|min:1',
            'tanggal'   => 'required|date',
            'gudang_id' => 'required|exists:gudang,id',
        ]);

        DB::transaction(function () use ($validated, $stokMasuk) {
            $oldBarang = $stokMasuk->barang;     
            $oldJumlah = (int) $stokMasuk->jumlah;

            // cari / buat barang by kode baru
            $newBarang = Barang::where('kode', $validated['kode'])->first();

            if (!$newBarang) {
                $newBarang = Barang::create([
                    'kode' => $validated['kode'],
                    'nama' => $validated['nama'],
                    'jenis' => $validated['jenis'],
                    'satuan' => $validated['satuan'],
                    'stok_unit' => 0,
                    'stok_dapat_dijual' => 0,
                    'gudang_id' => $validated['gudang_id'],
                ]);
            } else {
                $newBarang->update([
                    'nama' => $validated['nama'],
                    'jenis' => $validated['jenis'],
                    'satuan' => $validated['satuan'],
                    'gudang_id' => $validated['gudang_id'],
                ]);
            }

            // rollback stok barang lama
            if ($oldBarang) {
                $oldBarang->decrement('stok_unit', $oldJumlah);
                $oldBarang->decrement('stok_dapat_dijual', $oldJumlah);
            }

            // update stok masuk
            $stokMasuk->update([
                'barang_id' => $newBarang->id,
                'gudang_id' => $validated['gudang_id'],
                'jumlah' => $validated['jumlah'],
                'tanggal' => $validated['tanggal'],
            ]);

            // apply stok barang baru 
            $newBarang->increment('stok_unit', (int)$validated['jumlah']);
            $newBarang->increment('stok_dapat_dijual', (int)$validated['jumlah']);
        });

        return redirect()->route('stok-masuk', request()->query())
            ->with('toast', ['type'=>'success','title'=>'Berhasil!','message'=>'Data berhasil diperbarui!']);
    }

    public function destroy(StokMasuk $stokMasuk)
    {
        DB::transaction(function () use ($stokMasuk) {
            $barang = $stokMasuk->barang;
            $jumlah = (int) $stokMasuk->jumlah;

            $stokMasuk->delete();

            if ($barang) {
                $barang->decrement('stok_unit', $jumlah);
                $barang->decrement('stok_dapat_dijual', $jumlah);
            }
        });

        return redirect()->route('stok-masuk', request()->query())
            ->with('toast', ['type'=>'success','title'=>'Berhasil!','message'=>'Data berhasil dihapus!']);
    }
}