<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Gudang;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Exports\BarangExport;

class BarangController extends Controller
{
    public function index(Request $request)
    {

        $perPage = (int) $request->get('per_page', 10);

      
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $barangs = Barang::with('gudang')
            ->orderBy('kode', 'asc')
            ->paginate($perPage)
            ->appends($request->query()); 

        $gudangs = Gudang::orderBy('nama', 'asc')->get();

        return view('barang.index', compact('barangs', 'gudangs', 'perPage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'               => 'required|string|max:50|unique:barang,kode',
            'nama'               => 'required|string|max:255',
            'jenis'              => 'required|string|max:50',
            'satuan'             => 'required|string|max:30',
            'stok_unit'          => 'required|integer|min:0',
            'stok_dapat_dijual'  => 'required|integer|min:0',
            'gudang_id'          => 'required|exists:gudang,id',
        ]);

        Barang::create($validated);

        return redirect()
            ->route('data-barang', request()->only('per_page', 'page'))
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil ditambahkan!'
            ]);
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            
            'kode'               => 'required|string|max:50|unique:barang,kode,' . $barang->id,
            'nama'               => 'required|string|max:255',
            'jenis'              => 'required|string|max:50',
            'satuan'             => 'required|string|max:30',
            'stok_unit'          => 'required|integer|min:0',
            'stok_dapat_dijual'  => 'required|integer|min:0',
            'gudang_id'          => 'required|exists:gudang,id',
        ]);

        $barang->update($validated);

        return redirect()
            ->route('data-barang', request()->only('per_page', 'page'))
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil diperbarui!'
            ]);
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('data-barang', request()->only('per_page', 'page'))
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Data berhasil dihapus!'
            ]);
    }

    public function exportExcel()
    {
        return Excel::download(new BarangExport, 'data-barang.xlsx');
    }

    public function exportPdf()
    {
        $barangs = Barang::with('gudang')->orderBy('kode', 'asc')->get();
        $pdf = Pdf::loadView('barang.pdf', compact('barangs'));
        return $pdf->download('data-barang.pdf');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);


        return redirect()
            ->route('data-barang', request()->only('per_page', 'page'))
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Import Excel berhasil (aktifkan class import).'
            ]);
    }

    public function importPdf(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf',
        ]);

        return redirect()
            ->route('data-barang', request()->only('per_page', 'page'))
            ->with('toast', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Import PDF belum disupport.'
            ]);
    }
}