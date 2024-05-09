<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPembelian;
use App\Models\Vendor;
use Illuminate\Http\Request;

class TransaksiPembelianController extends Controller
{
    public function index()
    {
        $pembelian = TransaksiPembelian::with('vendor')->get();
        return view('pembelian.pembelian-index', compact('pembelian'));
    }


    public function create()
    {
        $vendor = Vendor::all();
        return view('pembelian.pembelian-create', compact('vendor'));
    }


    public function store(Request $request)
    {

        // $request->validate($request->all());

        // dd($barang);
        TransaksiPembelian::create([
            'no_pembelian' => $request->no_pembelian,
            'vendor_id' => $request->vendor_id,
            'harga' => $request->harga,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'total_pembelian' => 0,


        ]);

        return redirect()->route('pembelian.index')->with('success', 'Transaksi Berhasil di Input');
    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $pembelian = TransaksiPembelian::find($id);
        // dd($pembelian);
        $vendor = Vendor::all();
        return view('pembelian.pembelian-edit', compact('pembelian', 'vendor'));
    }


    public function update(Request $request, $id)
    {




        $pembelian = TransaksiPembelian::find($id);

        $pembelian->no_pembelian = $request->no_pembelian;
        $pembelian->vendor_id = $request->vendor_id;
        $pembelian->tanggal_pembelian = $request->tanggal_pembelian;
        $pembelian->harga = $request->harga;
        $pembelian->jenis_pembayaran = $request->jenis_pembayaran;

        $pembelian->save();

        return redirect()->route('pembelian.index')->with('success', 'Transaksi Berhasil di edit');
    }

    public function destroy($id)
    {
        $pembelian = TransaksiPembelian::find($id);
        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Transaksi Berhasil di hapus');
    }
}
