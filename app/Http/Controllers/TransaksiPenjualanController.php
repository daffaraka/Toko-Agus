<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\PenjualanBarang;
use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\Validator;

class TransaksiPenjualanController extends Controller
{

    public function index()
    {
        $penjualan = TransaksiPenjualan::with(['pelanggan', 'penjualanBarang.barang'])->get();

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


        $request->validate(
            [
                'qty.*' => 'required|numeric|gt:0',
            ],
            [
                'qty.*.gt' => 'Qty tidak boleh 0',
            ]
        );



        // dd($request->all());


        $sisa_pembayaran = 0;
        $finalTotal = 0;

        $transaksiPenjual = new TransaksiPenjualan();
        $transaksiPenjual->no_penjualan = $request->no_penjualan;
        $transaksiPenjual->pelanggan_id = $request->id_pelanggan;
        $transaksiPenjual->kasir = $request->kasir;
        $transaksiPenjual->tanggal_penjualan = Carbon::now()->toDateString();
        $transaksiPenjual->jenis_pembayaran = $request->jenis_pembayaran;
        $transaksiPenjual->tanggal_jatuh_tempo = $request->tanggal_jatuh_tempo;
        $transaksiPenjual->save();

        for ($i = 0; $i < count($request->id_barang); $i++) {
            $barang = Barang::find($request->id_barang[$i]);
            $total = $request->qty[$i] * $barang->harga;
            $finalTotal += $total;


            $penjualanBarang = new PenjualanBarang();
            $penjualanBarang->penjualan_id = $transaksiPenjual->id;
            $penjualanBarang->barang_id = $request->id_barang[$i];
            $penjualanBarang->qty = $request->qty[$i];
            $penjualanBarang->total = $total;
            $penjualanBarang->save();


            $barang->stok -= $request->qty[$i];
            $barang->save();
        }

        if ($request->jenis_pembayaran == 'Cicil') {
            $sisa_pembayaran = $finalTotal / 2;
        } else {
            $sisa_pembayaran = 0;
        }

        $transaksiPenjual->sisa_pembayaran = $sisa_pembayaran;
        $transaksiPenjual->total_penjualan = $finalTotal;
        $transaksiPenjual->save();

        return redirect()->route('penjualan.index')->with('success', 'Transaksi Berhasil di Input');
    }


    public function edit($id)
    {
        $penjualan = TransaksiPenjualan::with(['penjualanBarang.barang'])->find($id);
        // dd($penjualan);
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('penjualan.penjualan-edit', compact('penjualan', 'pelanggan', 'barang'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'qty.*' => 'required|numeric|gt:0',
            ],
            [
                'qty.*.gt' => 'Qty tidak boleh 0',
            ]
        );

        $sisa_pembayaran = 0;
        $finalTotal = 0;

        $transaksiPenjual = TransaksiPenjualan::find($id);

        $transaksiPenjual->barang()->detach();

        $transaksiPenjual->no_penjualan = $request->no_penjualan;
        $transaksiPenjual->pelanggan_id = $request->id_pelanggan;
        $transaksiPenjual->kasir = $request->kasir;
        $transaksiPenjual->tanggal_penjualan = Carbon::now()->toDateString();
        $transaksiPenjual->jenis_pembayaran = $request->jenis_pembayaran;
        $transaksiPenjual->save();

        for ($i = 0; $i < count($request->id_barang); $i++) {
            $barang = Barang::find($request->id_barang[$i]);

            $total = $request->qty[$i] * $barang->harga;
            $finalTotal += $total; // Menambahkan total individu ke $finalTotal

            $transaksiPenjual->barang()->attach($request->id_barang[$i], [
                'qty' => $request->qty[$i],
                'total' => $total
            ]);

            $barang->stok -= $request->qty[$i];
            $barang->save();
        }

        if ($request->jenis_pembayaran == 'Cicil') {
            $sisa_pembayaran = $finalTotal / 2;
        } else {
            $sisa_pembayaran = 0;
        }

        $transaksiPenjual->sisa_pembayaran = $sisa_pembayaran;
        $transaksiPenjual->save();
        return redirect()->route('penjualan.index')->with('success', 'Transaksi Berhasil di edit');
    }

    public function destroy($id)
    {
        $penjualan = TransaksiPenjualan::find($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Transaksi Berhasil di hapus');
    }
}
