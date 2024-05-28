<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Vendor;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\TransaksiPembelian;

class TransaksiPembelianController extends Controller
{
    public function index()
    {
        $pembelian = TransaksiPembelian::with('supplier')->get();
        return view('pembelian.pembelian-index', compact('pembelian'));
    }


    public function create()
    {
        $barang = Barang::all();
        $supplier = Supplier::all();
        return view('pembelian.pembelian-create', compact('supplier','barang'));
    }


    public function store(Request $request)
    {

        // dd($request->all());
        $barang = Barang::find($request->id_barang);

        // dd($barang);
        // $request->validate($request->all());
        $total = $request->qty * $barang->harga;

        $sisa_pembayaran = 0;

        if($request->jenis_pembayaran == 'Cicil') {
            $sisa_pembayaran = $total / 2;
        }

        // dd($barang);
        $transaksi =   TransaksiPembelian::create([
            'no_pembelian' => $request->no_pembelian,
            'supplier_id' => $request->supplier_id,
            'barang_id' => $request->id_barang,
            'qty_brg' => $request->qty,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'sisa_pembayaran' => $sisa_pembayaran,
            'tanggal_pembelian' =>Carbon::now()->toDateString(),
            'total_pembelian' => $total,


        ]);

        if($transaksi){
            $barang->stok += $request->qty;
            $barang->save();

        }

        return redirect()->route('pembelian.index')->with('success', 'Transaksi Berhasil di Input');
    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $pembelian = TransaksiPembelian::find($id);
        // dd($pembelian);
        $supplier = Supplier::all();
        $barang = Barang::all();
        return view('pembelian.pembelian-edit', compact('pembelian', 'supplier','barang'));
    }


    public function update(Request $request, $id)
    {


        $barang = Barang::find($request->id_barang);

        // dd($barang);
        // $request->validate($request->all());
        $total = $request->qty * $barang->harga;

        $sisa_pembayaran = 0;

        if($request->jenis_pembayaran == 'Cicil') {
            $sisa_pembayaran = $total / 2;
        }

        dd($sisa_pembayaran);
        $pembelian = TransaksiPembelian::find($id);

        $pembelian->no_pembelian = $request->no_pembelian;
        $pembelian->supplier_id = $request->supplier_id;
        $pembelian->barang_id = $request->id_barang;
        $pembelian->tanggal_pembelian = $request->tanggal_pembelian;
        $pembelian->jenis_pembayaran = $request->jenis_pembayaran;
        $pembelian->barang_id = $request->id_barang;
        $pembelian->total_pembelian = $total;

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
