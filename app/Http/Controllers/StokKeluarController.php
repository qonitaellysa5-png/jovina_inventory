<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\StokKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokKeluarController extends Controller
{
    private array $masterGudang = [
        'Gudang Masuk',
        'Gudang Penjualan',
        'Gudang Retur',
        'Gudang Rusak',
    ];

    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = in_array($perPage, [10,25,50,100]) ? $perPage : 10;

        $this->ensureMasterGudangExists();

        $gudangs = Gudang::whereIn('nama', $this->masterGudang)
            ->orderBy('nama', 'asc')
            ->get();

        $stokKeluars = StokKeluar::with(['barang','gudang'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        return view('stokkeluar.index', compact('stokKeluars', 'gudangs', 'perPage'));
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

        DB::transaction(function() use ($validated) {
            $barangId = $this->getOrCreateBarang($validated);
            StokKeluar::create([
                'barang_id' => $barangId,
                'gudang_id' => (int) $validated['gudang_id'],
                'jumlah'    => (int) $validated['jumlah'],
                'tanggal'   => $validated['tanggal'],
            ]);
        });

        return redirect()->route('stok-keluar')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'message' => 'Data stok keluar berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, StokKeluar $stokKeluar)
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

        DB::transaction(function() use ($validated, $stokKeluar) {
            $barangId = $this->getOrCreateBarang($validated);

            $stokKeluar->update([
                'barang_id' => $barangId,
                'gudang_id' => (int) $validated['gudang_id'],
                'jumlah'    => (int) $validated['jumlah'],
                'tanggal'   => $validated['tanggal'],
            ]);
        });

        return redirect()->route('stok-keluar')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'message' => 'Data stok keluar berhasil diperbarui!'
        ]);
    }

    public function destroy(StokKeluar $stokKeluar)
    {
        $stokKeluar->delete();

        return redirect()->route('stok-keluar')->with('toast', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'message' => 'Data stok keluar berhasil dihapus!'
        ]);
    }


    public function exportExcel()
    {
       
        return back()->with('toast', [
            'type' => 'info',
            'title' => 'Info',
            'message' => 'Export Excel belum diimplementasikan.'
        ]);
    }

    public function exportPdf()
    {
      
        return back()->with('toast', [
            'type' => 'info',
            'title' => 'Info',
            'message' => 'Export PDF belum diimplementasikan.'
        ]);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

       
        return back()->with('toast', [
            'type' => 'info',
            'title' => 'Info',
            'message' => 'Import Excel belum diimplementasikan.'
        ]);
    }

    public function importPdf(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf'
        ]);

     
        return back()->with('toast', [
            'type' => 'info',
            'title' => 'Info',
            'message' => 'Import PDF belum diimplementasikan.'
        ]);
    }

    private function ensureMasterGudangExists(): void
    {
        foreach ($this->masterGudang as $nama) {
            Gudang::firstOrCreate(['nama' => $nama]);
        }
    }

    private function getOrCreateBarang(array $data): int
    {
        $kode = trim($data['kode']);
        $barang = Barang::where('kode', $kode)->first();

        if ($barang) {
            
            $barang->update([
                'nama'      => $data['nama'],
                'jenis'     => $data['jenis'],
                'satuan'    => $data['satuan'],
                'gudang_id' => (int) $data['gudang_id'], 
            ]);
            return (int) $barang->id;
        }

        $barang = Barang::create([
            'kode'      => $kode,
            'nama'      => $data['nama'],
            'jenis'     => $data['jenis'],
            'satuan'    => $data['satuan'],
            'gudang_id' => (int) $data['gudang_id'], 
        ]);

        return (int) $barang->id;
    }
}