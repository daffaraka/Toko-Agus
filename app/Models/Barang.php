<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    // untuk melist kolom yang dapat diisi
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'jumlah',
        'stok',
        'harga_beli',
        'harga',
    ];



    public function pembelianBarang()
    {
        return $this->belongsToMany(PembelianBarang::class,'pembelian_barangs','barang_id','pembelian_id')->withPivot('qty', 'total');
    }


    public function pembelian()
    {
        return $this->hasMany(TransaksiPembelian::class,'id');
    }

}
