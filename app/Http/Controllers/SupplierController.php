<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

use Illuminate\Foundation\Http\FormRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //query data
        $supplier = Supplier::all();
        return view('supplier/view',
                    [
                        'supplier' => $supplier
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'id_supplier' => 'required',
            'nama_supplier' => 'required',
            'no_telp' => 'required',
            'alamat_supplier' => 'required',
        ]);

        // masukkan ke db
        Supplier::create($request->all());
        
        return redirect()->route('supplier.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'id_supplier' => 'required',
            'nama_supplier' => 'required',
            'no_telp' => 'required',
            'alamat_supplier' => 'required',
        ]);
    
        $supplier->update($validated);
    
        return redirect()->route('supplier.index')->with('success','Data Berhasil di Ubah');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_supplier)
    {
        //hapus dari database
        $supplier = Supplier::findOrFail($id_supplier);
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success','Data Berhasil di Hapus');
    }
}
