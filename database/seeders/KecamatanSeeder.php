<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Tarogong Kidul',
            'Tarogong Kaler',
            'Garut Kota',
            'Sucinaraja',
            'Cikajang',
            'Cisurupan',
            'Blubur Limbangan',
            'Banyuresmi',
            'Selaawi',
            'Karangpawitan',
            'Cilawu',
            'Wanaraja',
            'Pangatikan',
            'Leles',
            'Kadungora',
            'Cibiuk',
            'Cibatu',
            'Pamulihan',
            'Talegong',
            'Bungbulang',
            'Pameungpeuk',
            'Cisewu',
            'Cikelet',
            'Singajaya',
            'Cibalong',
            'Mekarmukti',
            'Cisompet',
            'Bayongbong',
            'Peundeuy',
            'Malangbong'
        ];

        foreach ($items as $name) {
            Kecamatan::updateOrCreate(['nama' => $name], ['keterangan' => null]);
        }
    }
}
