<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggan::create(
            [
                'nama_pelanggan' => 'Pelanggan 1',
                'no_telp' => 8888888,
                'alamat_pelanggan' => 20,
            ]
        );
    }
}
