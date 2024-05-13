<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create(
            [
                'nama_supplier' => 'Supplier 1',
                'no_telp' => 88889999,
                'alamat_supplier' => 'Bandung',
            ]
        );


        Supplier::create(
            [
                'nama_supplier' => 'Supplier 2',
                'no_telp' => 99999,
                'alamat_supplier' => 'Jakarta',
            ]
        );
    }
}
