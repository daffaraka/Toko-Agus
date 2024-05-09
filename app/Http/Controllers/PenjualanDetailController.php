<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetail;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Barang;
use App\Http\Requests\StorePenjualanDetailRequest;
use App\Http\Requests\UpdatePenjualanDetailRequest;

class PenjualanDetailController extends Controller
{
    public function index()
    {
      $barang = Barang::orderBy('nama_barang')->get();
      $pelanggan = Pelanggan::orderBy('nama')->get();
    }

}
       