<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PelunasanPenjualan;
use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;

class PelunasanPenjualanController extends Controller
{
    public function index()
    {
        $plnPenjualan = TransaksiPenjualan::with('penjualanBarang.barang')->whereJenisPembayaran('cicil')->get();

        return view('pelunasan-penjualan.plns-penjualan-index', compact('plnPenjualan'));
    }


    public function create()
    {
        $pembelian = TransaksiPenjualan::where('jenis_pembayaran','Cicil')->get();
        $barang = Barang::all();
        return view('pelunasan-pembelian.plns-pembelian-create', compact('pembelian', 'barang'));
    }


    public function store(Request $request)
    {



        $transPenjualan = TransaksiPenjualan::find($request->penjualan_id);


        if($request->nominal_pembayaran > $transPenjualan->sisa_pembayaran)
        {
            return redirect()->back()->with('error','Nominal pembayaran melebihi sisa pembayaran');
        }


        $transPenjualan->sisa_pembayaran -= $request->nominal_pembayaran;
        $transPenjualan->save();

        PelunasanPenjualan::create([
            'penjualan_id' => $request->penjualan_id,
            'nominal_pembayaran' => $request->nominal_pembayaran,

        ]);

        return redirect()->back()->with('success', 'Transaksi Pelunasan Pembelian Berhasil di Input');
    }

    public function pembayaran($id)
    {
        $plnPenjualan = TransaksiPenjualan::with(['pelanggan','penjualanBarang.barang'])->find($id);

        $dataPelunasan = PelunasanPenjualan::where('penjualan_id',$id)->get();

        return view('pelunasan-penjualan.plns-penjualan-pelunasan', compact('plnPenjualan','dataPelunasan'));
    }
}
