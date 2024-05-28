<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\Validator;

class TransaksiPenjualanController extends Controller
{

    public function index()
    {
        $penjualan = TransaksiPenjualan::with(['pelanggan', 'barang'])->get();

        return view('penjualan.penjualan-index', compact('penjualan'));
    }


    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('penjualan.penjualan-create', compact('pelanggan', 'barang'));
    }


    public function store(Request $request)
    {

        // $request->validate($request->all());

        $barang = Barang::find($request->id_barang);

        // dd($barang);
        $total = $request->qty * $barang->harga;



        $transaksi =  TransaksiPenjualan::create([
            'no_penjualan' => $request->no_penjualan,
            'pelanggan_id' => $request->id_pelanggan,
            'kasir' => $request->kasir,
            'barang_id' => $request->id_barang,
            'tanggal_penjualan' => Carbon::now()->toDateString(),
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'qty_brg' => $request->qty,
            'total' => $total,


        ]);

        if ($transaksi) {
            $barang->stok -= $request->qty;
            $barang->save();
        }

        return redirect()->route('penjualan.index')->with('success', 'Transaksi Berhasil di Input');
    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $penjualan = TransaksiPenjualan::find($id);
        // dd($penjualan);
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('penjualan.penjualan-edit', compact('penjualan', 'pelanggan', 'barang'));
    }


    public function update(Request $request, $id)
    {

        $barang = Barang::find($request->id_barang);


        $total = $request->qty * $barang->harga;

        $penjualan = TransaksiPenjualan::find($id);
        $penjualan->no_penjualan = $request->no_penjualan;
        $penjualan->pelanggan_id = $request->id_pelanggan;
        $penjualan->kasir = $request->kasir;
        $penjualan->barang_id = $request->id_barang;
        $penjualan->tanggal_penjualan = $request->tanggal_penjualan;
        $penjualan->jenis_pembayaran = $request->jenis_pembayaran;
        $penjualan->total = $total;
        $penjualan->qty_brg = $request->qty;
        $penjualan->save();

        if ($penjualan->save()) {
            $barang->stok -= $request->qty;
            $barang->save();
        }
        return redirect()->route('penjualan.index')->with('success', 'Transaksi Berhasil di edit');
    }

    public function destroy($id)
    {
        $penjualan = TransaksiPenjualan::find($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Transaksi Berhasil di hapus');
    }
}
