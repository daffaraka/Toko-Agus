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
        $plnPenjualan = TransaksiPenjualan::whereJenisPembayaran('cicil')->get();

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


        $transPembelian = TransaksiPenjualan::find($request->penjualan_id);
        $transPembelian->sisa_pembayaran -= $request->nominal_pembayaran;
        $transPembelian->save();

        PelunasanPenjualan::create([
            'penjualan_id' => $request->penjualan_id,
            'nominal_pembayaran' => $request->nominal_pembayaran,

        ]);

        return redirect()->back()->with('success', 'Transaksi Pelunasan Pembelian Berhasil di Input');
    }

    public function pembayaran($id)
    {
        $plnPenjualan = TransaksiPenjualan::with(['pelanggan','barang'])->find($id);

        $dataPelunasan = PelunasanPenjualan::all();

        return view('pelunasan-penjualan.plns-penjualan-pelunasan', compact('plnPenjualan','dataPelunasan'));
    }
}
