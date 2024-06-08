<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StokbarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create(
            [
                'nama_barang' => 'Barang 1',
                'jumlah' => 10,
                'stok' => 20,
                'harga_beli' => 1500,
                'harga' => 5000,

            ]
        );


        Barang::create(
            [
                'nama_barang' => 'Pulpen',
                'jumlah' => 50,
                'stok' => 100,
                'harga_beli' => 3000,
                'harga' => 10000,

            ]
        );


        Barang::create(
            [
                'nama_barang' => 'Pensil',
                'jumlah' => 50,
                'stok' => 100,
                'harga_beli' => 2500,
                'harga' => 7500,

            ]
        );
    }
}
