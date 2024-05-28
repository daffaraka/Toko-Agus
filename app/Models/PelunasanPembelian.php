<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelunasanPembelian extends Model
{
    use HasFactory;

    protected $fillable =
    [

        'pembelian_id',
        'nominal_pembayaran',
    ];


    public function pembelian()
    {
       return $this->belongsTo(TransaksiPembelian::class,'pembelian_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
