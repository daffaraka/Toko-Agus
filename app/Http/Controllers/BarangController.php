<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

use Illuminate\Foundation\Http\FormRequest;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query data
        $barang = Barang::all();
        return view(
            'barang/view',
            [
                'barang' => $barang
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'stok' => 'required',
            'harga_beli' => 'required',
            'harga' => 'required',
        ]);

        // masukkan ke db
        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'stok' => 'required',
            'harga_beli' => 'required',
            'harga' => 'required',
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Data Berhasil di Ubah');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang)
    {
        //hapus dari database
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data Berhasil di Hapus');
    }
}
