<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianBarang extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'pembelian_id',
        'barang_id',
        'qty',
        'total'
    ];


    /**
     * Get the pembelian that owns the PembelianBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class,'pembelian_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
}
