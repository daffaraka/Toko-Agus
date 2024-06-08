<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\PelunasanPembelian;
use App\Models\TransaksiPembelian;

class PelunasanPembelianController extends Controller
{
    public function index()
    {
        $plnPembelian = TransaksiPembelian::with('pembelianBarang.barang')->whereJenisPembayaran('cicil')->get();

        return view('pelunasan-pembelian.plns-pembelian-index', compact('plnPembelian'));
    }


    public function create()
    {
        $pembelian = TransaksiPembelian::where('jenis_pembayaran','Cicil')->get();
        $barang = Barang::all();
        return view('pelunasan-pembelian.plns-pembelian-create', compact('pembelian', 'barang'));
    }


    public function store(Request $request)
    {


        $transPembelian = TransaksiPembelian::find($request->pembelian_id);


        if($request->nominal_pembayaran > $transPembelian->sisa_pembayaran)
        {
            return redirect()->back()->with('error','Nominal pembayaran melebihi sisa pembayaran');
        }
        $transPembelian->sisa_pembayaran -= $request->nominal_pembayaran;
        $transPembelian->save();

        PelunasanPembelian::create([
            'pembelian_id' => $request->pembelian_id,
            'nominal_pembayaran' => $request->nominal_pembayaran,

        ]);

        return redirect()->back()->with('success', 'Transaksi Pelunasan Pembelian Berhasil di Input');
    }

    public function pembayaran($id)
    {
        $plnPembelian = TransaksiPembelian::with(['supplier','pembelianBarang.barang'])->find($id);

        $dataPelunasan = PelunasanPembelian::where('pembelian_id',$id)->get();
        return view('pelunasan-pembelian.plns-pembelian-pelunasan', compact('plnPembelian','dataPelunasan'));
    }

}
