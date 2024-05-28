<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'no_penjualan',
        'pelanggan_id',
        // 'jenis_pembayaran',
        'kasir',
        'barang_id',
        'tanggal_penjualan',
        'total',
        'qty_brg',
        'jenis_pembayaran',
    ];


    /**
     * Get the pelanggan that owns the TransaksiPenjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class,'pelanggan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
