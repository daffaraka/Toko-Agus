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
        $plnPembelian = TransaksiPembelian::whereJenisPembayaran('cicil')->get();

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
        $plnPembelian = TransaksiPembelian::with(['supplier','barang'])->find($id);

        $dataPelunasan = PelunasanPembelian::all();

        return view('pelunasan-pembelian.plns-pembelian-pelunasan', compact('plnPembelian','dataPelunasan'));
    }


    public function edit($id)
    {
        $plnPembelian = PelunasanPembelian::find($id);
        // dd($plnPembelian);
        $pembelian = TransaksiPembelian::where('jenis_pembayaran','Cicil')->get();
        $barang = Barang::all();
        return view('pelunasan-pembelian.plns-pembelian-edit', compact('plnPembelian', 'pembelian', 'barang'));
    }


    public function update(Request $request, $id)
    {

        $barang = Barang::find($request->id_barang);

        $transPembelian = TransaksiPembelian::find($request->pembelian_id);
        $transPembelian->sisa_pembayaran -= $request->nominal_pembayaran;
        $transPembelian->save();



        // $plnPembelian = PelunasanPembelian::find($id);
        // $plnPembelian->pembelian_id = $request->pembelian_id;
        // $plnPembelian->barang_id = $request->id_barang;
        // $plnPembelian->sisa_pembayaran = $sisa_pembayaran;
        // $plnPembelian->total = $total;
        // $plnPembelian->qty = $request->qty;
        // $plnPembelian->save();

        return redirect()->route('pelunasanPembelian.index')->with('success', 'Transaksi Pelunasan Pembelian Berhasil di perbarui');
    }

    public function destroy($id)
    {
        $plnPembelian = PelunasanPembelian::find($id);
        $plnPembelian->delete();

        return redirect()->route('pelunasanPembelian.index')->with('success', 'Transaksi Berhasil di hapus');
    }
}
