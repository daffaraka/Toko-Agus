<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarang extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'penjualan_id',
        'barang_id',
        'qty',
        'total',
    ];



    public function penjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class,'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
