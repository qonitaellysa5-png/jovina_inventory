<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Models\Barang;

class GudangController extends Controller
{

    public function index()
    {
       
        $gudangMasuk     = Gudang::where('nama', 'Gudang Masuk')->first();
        $gudangPenjualan = Gudang::where('nama', 'Gudang Penjualan')->first();
        $gudangRusak     = Gudang::where('nama', 'Gudang Rusak')->first();
        $gudangRetur     = Gudang::where('nama', 'Gudang Retur')->first();

       
        $countMasuk = $gudangMasuk
            ? Barang::where('gudang_id', $gudangMasuk->id)->count()
            : 0;

        $countPenjualan = $gudangPenjualan
            ? Barang::where('gudang_id', $gudangPenjualan->id)->count()
            : 0;

        $countRusak = $gudangRusak
            ? Barang::where('gudang_id', $gudangRusak->id)->count()
            : 0;

        $countRetur = $gudangRetur
            ? Barang::where('gudang_id', $gudangRetur->id)->count()
            : 0;

       
        $gudangsAll = Gudang::orderBy('nama', 'asc')->get();

        return view('gudang.index', compact(
            'countMasuk',
            'countPenjualan',
            'countRusak',
            'countRetur',
            'gudangsAll'
        ));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:gudang,nama',
        ]);

        Gudang::create($validated);

        return redirect()->route('gudang')
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Gudang berhasil ditambahkan!'
            ]);
    }

    // =========================
    // HALAMAN BARANG PER GUDANG 
    // =========================
    private function barangByGudangNama(Request $request, string $namaGudang)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;

        $gudang = Gudang::where('nama', $namaGudang)->firstOrFail();

        $barangs = Barang::with('gudang')
            ->where('gudang_id', $gudang->id)
            ->orderBy('kode', 'asc')
            ->paginate($perPage)
            ->appends($request->query());

        return view('gudang.barang', compact('gudang', 'barangs', 'perPage'));
    }

    // =========================
    // ROUTE: gudang.masuk
    // =========================
    public function barangMasuk(Request $request)
    {
        return $this->barangByGudangNama($request, 'Gudang Masuk');
    }

    // =========================
    // ROUTE: gudang.penjualan
    // =========================
    public function barangPenjualan(Request $request)
    {
        return $this->barangByGudangNama($request, 'Gudang Penjualan');
    }

    // =========================
    // ROUTE: gudang.rusak
    // =========================
    public function barangRusak(Request $request)
    {
        return $this->barangByGudangNama($request, 'Gudang Rusak');
    }

    // =========================
    // ROUTE: gudang.retur
    // =========================
    public function barangRetur(Request $request)
    {
        return $this->barangByGudangNama($request, 'Gudang Retur');
    }
}