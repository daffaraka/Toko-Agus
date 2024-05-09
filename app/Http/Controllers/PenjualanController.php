<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;

use App\Models\Barang;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth; //untuk mendapatkan auth

class PenjualanController extends Controller
{
    public function index()
    {
    $penjualan = Penjualan::all();
    return view('penjualan/view',
                [
                    'penjualan' => $penjualan
                ]
                );
            }


    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan = new Penjualan();

    }
}
