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
        'supplier_id',
        'barang_id',
        'tanggal_pembelian',
        'qty_brg',
        'total_pembelian',
        'sisa_pembayaran',
        'jenis_pembayaran',

    ];


    /**
     * Get the pelanggan that owns the TransaksiPenjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function barang()
    {
        return $this->belongsToMany(PembelianBarang::class,'pembelian_barangs','pembelian_id','barang_id');

    }

    public function pembelianBarang()
    {
        return $this->hasMany(PembelianBarang::class,'pembelian_id');
    }

}
