<?php

namespace App\Http\Controllers;

use App\Models\Stokbarang;
use App\Http\Requests\StoreStokbarangRequest;
use App\Http\Requests\UpdateStokbarangRequest;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Validator;

class StokbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stokbarang = Stokbarang::all();
        // var_dump($stokbarang);
        // dd;
    	// mengirim data pegawai ke view pegawai
        
    	return view('stokbarang/view', 
                        [
                            'stokbarang' => $stokbarang,
                        ]
                    );
    }

    public function fetchstokbarang()
    {
        $stokbarang = Stokbarang::all();
        return response()->json([
            'stokbarang'=>$stokbarang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStokbarangRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'nama_barang' => 'required|min:3',
                'jumlah' => 'required',
                'harga_beli' => 'required',
            ]
        );

        if($validator->fails()){
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        }else{
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah
            
            if($request->input('tipeproses')=='tambah'){
                // simpan ke db
                Stokbarang ::create($request->all());
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                $stokbarang = Stokbarang::find($request->input('idstokbaranghidden'));
            
                // proses update dari inputan form data
                $stokbarang->nama_barang = $request->input('nama_barang');
                $stokbarang->jumlah = $request->input('jumlah');
                $stokbarang->harga_beli = $request->input('harga_beli');
                $stokbarang->update(); //proses update ke db

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Update Data',
                    ]
                );
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Stokbarang $stokbarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stokbarang = Stokbarang::find($id);
        if($stokbarang)
        {
            return response()->json([
                'status'=>200,
                'stokbarang'=> $stokbarang,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStokbarangRequest $request, Stokbarang $stokbarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         //hapus dari database
         $stokbarang = Stokbarang::findOrFail($id);
         $stokbarang->delete();
         return view('stokbarang/view',
             [
                 'stokbarang' => $stokbarang,
                 'status_hapus' => 'Sukses Hapus'
             ]
         );
    }
}