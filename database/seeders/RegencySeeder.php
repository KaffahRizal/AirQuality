<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegencySeeder extends Seeder
{
    public function run(): void
    {
        // Seeder untuk memasukkan data kabupaten/kota (regencies)
        DB::table('regencies')->insert([
            ['id' => 1101, 'province_id' => 11, 'name' => 'KABUPATEN SIMEULUE', 'alt_name' => 'KABUPATEN SIMEULUE', 'latitude' => 2.616670, 'longitude' => 96.083330],
            ['id' => 1102, 'province_id' => 11, 'name' => 'KABUPATEN ACEH SINGKIL', 'alt_name' => 'KABUPATEN ACEH SINGKIL', 'latitude' => 2.416670, 'longitude' => 97.916670],
            ['id' => 1103, 'province_id' => 11, 'name' => 'KABUPATEN ACEH SELATAN', 'alt_name' => 'KABUPATEN ACEH SELATAN', 'latitude' => 3.166670, 'longitude' => 97.416670],
            ['id' => 1104, 'province_id' => 11, 'name' => 'KABUPATEN ACEH TENGGARA', 'alt_name' => 'KABUPATEN ACEH TENGGARA', 'latitude' => 3.366670, 'longitude' => 97.700000],
            ['id' => 1105, 'province_id' => 11, 'name' => 'KABUPATEN ACEH TIMUR', 'alt_name' => 'KABUPATEN ACEH TIMUR', 'latitude' => 4.633330, 'longitude' => 97.633330],
            ['id' => 1106, 'province_id' => 11, 'name' => 'KABUPATEN ACEH TENGAH', 'alt_name' => 'KABUPATEN ACEH TENGAH', 'latitude' => 4.510000, 'longitude' => 96.855000],
            ['id' => 1107, 'province_id' => 11, 'name' => 'KABUPATEN ACEH BARAT', 'alt_name' => 'KABUPATEN ACEH BARAT', 'latitude' => 4.450000, 'longitude' => 96.166670],
            ['id' => 1108, 'province_id' => 11, 'name' => 'KABUPATEN ACEH BESAR', 'alt_name' => 'KABUPATEN ACEH BESAR', 'latitude' => 5.383330, 'longitude' => 95.516670],
            ['id' => 1109, 'province_id' => 11, 'name' => 'KABUPATEN PIDIE', 'alt_name' => 'KABUPATEN PIDIE', 'latitude' => 5.080000, 'longitude' => 96.110000],
            ['id' => 1110, 'province_id' => 11, 'name' => 'KABUPATEN BIREUEN', 'alt_name' => 'KABUPATEN BIREUEN', 'latitude' => 5.083330, 'longitude' => 96.583330],
            ['id' => 1111, 'province_id' => 11, 'name' => 'KABUPATEN ACEH UTARA', 'alt_name' => 'KABUPATEN ACEH UTARA', 'latitude' => 4.970000, 'longitude' => 97.140000],
            ['id' => 1112, 'province_id' => 11, 'name' => 'KABUPATEN ACEH BARAT DAYA', 'alt_name' => 'KABUPATEN ACEH BARAT DAYA', 'latitude' => 3.833330, 'longitude' => 96.883330],
            ['id' => 1113, 'province_id' => 11, 'name' => 'KABUPATEN GAYO LUES', 'alt_name' => 'KABUPATEN GAYO LUES', 'latitude' => 3.950000, 'longitude' => 97.390000],
            ['id' => 1114, 'province_id' => 11, 'name' => 'KABUPATEN ACEH TAMIANG', 'alt_name' => 'KABUPATEN ACEH TAMIANG', 'latitude' => 4.250000, 'longitude' => 97.966670],
            ['id' => 1115, 'province_id' => 11, 'name' => 'KABUPATEN NAGAN RAYA', 'alt_name' => 'KABUPATEN NAGAN RAYA', 'latitude' => 4.166670, 'longitude' => 96.516670],
            ['id' => 1116, 'province_id' => 11, 'name' => 'KABUPATEN ACEH JAYA', 'alt_name' => 'KABUPATEN ACEH JAYA', 'latitude' => 4.860000, 'longitude' => 95.640000],
            ['id' => 1117, 'province_id' => 11, 'name' => 'KABUPATEN BENER MERIAH', 'alt_name' => 'KABUPATEN BENER MERIAH', 'latitude' => 4.730150, 'longitude' => 96.861560],
            ['id' => 1118, 'province_id' => 11, 'name' => 'KABUPATEN PIDIE JAYA', 'alt_name' => 'KABUPATEN PIDIE JAYA', 'latitude' => 5.150000, 'longitude' => 96.216670],
        ]);
    }
}
