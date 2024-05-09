<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stokbarang extends Model
{
    use HasFactory;

    protected $table = 'stokbarang';
    // untuk melist kolom yang dapat diisi
    protected $fillable = [
        'nama_barang',
        'jumlah',
        'harga_beli',
    ];


    /**
     * Get all of the transaksi_penjualan for the Stokbarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaksi_penjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class);
    }
}
