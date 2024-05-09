<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create(
            [
                'nama_vendor' => 'Vendor 1',
                'no_telp' => 88889999,
                'alamat_vendor' => 'Bandung',
            ]
            );


            Vendor::create(
                [
                    'nama_vendor' => 'Vendor 2',
                    'no_telp' => 99999,
                    'alamat_vendor' => 'Jakarta',
                ]
                );
    }
}
