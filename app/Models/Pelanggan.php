<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $fillable = ['nama_pelanggan', 'no_telp', 'alamat_pelanggan'];



    public function transaksi_penjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class);
    }
}
