<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder untuk memasukkan data provinsi yang diperlukan oleh regencies
        DB::table('provinces')->insert([
            [
                'id' => 11,
                'name' => 'ACEH',
                'alt_name' => 'ACEH',
                'latitude' => 4.695135,
                'longitude' => 96.749397
            ],
        ]);
    }
}
