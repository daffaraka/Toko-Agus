<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelunasanPenjualan extends Model
{
    use HasFactory;

    protected $fillable =
    [

        'penjualan_id',
        'nominal_pembayaran',
    ];

    public function pembelian()
    {
       return $this->belongsTo(TransaksiPenjualan::class,'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
