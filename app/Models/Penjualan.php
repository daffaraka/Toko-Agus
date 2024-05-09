<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// tambahan
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $guarded = [];

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
   
}
