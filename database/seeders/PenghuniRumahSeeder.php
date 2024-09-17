<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PenghuniRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            $rumah_id = $faker->numberBetween(1, 50);
            $warga_id = $faker->numberBetween(1, 50);
            $tgl_masuk = $faker->dateTimeBetween('2020-01-01', '2024-12-31')->format('Y-m-d');
            $tgl_keluar = $faker->dateTimeBetween('2020-01-01', '2024-12-31')->format('Y-m-d')

            DB::table('penghuni_rumahs')->insert([
                'rumah_id' => $rumah_id,
                'warga_id' => $warga_id,
                'tgl_masuk' => $tgl_masuk,
                'tgl_keluar' => $tgl_keluar,
            ]);
        }
    }
}
