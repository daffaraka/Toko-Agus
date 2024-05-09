<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable =
    [
        'no_pembelian',
        'vendor_id',
        'tanggal_pembelian',
        'harga',
        'total_pembelian',
        'jenis_pembayaran',
    ];


    /**
     * Get the pelanggan that owns the TransaksiPenjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
