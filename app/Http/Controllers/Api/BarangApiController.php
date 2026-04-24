<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangApiController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('gudang')->get();
        return response()->json($barangs);
    }

    public function store(Request $request)
    {
        $barang = Barang::create($request->all());
        return response()->json($barang, 201);
    }

    public function show($id)
    {
        $barang = Barang::with('gudang')->findOrFail($id);
        return response()->json($barang);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return response()->json($barang);
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}