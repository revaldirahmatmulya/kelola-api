<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    



        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {

            $tgl_pengeluaran = $faker->dateTimeBetween('2020-01-01', '2024-12-31')->format('Y-m-d');
            $keterangan = $faker->sentence(5);
            $jenis_pengeluaran = $faker->randomElement(['listrik', 'air', 'kebersihan']);
            $jumlah_pengeluaran = $faker->randomFloat(2, 1000, 100000);

            DB::table('pengeluarans')->insert([
                'tgl_pengeluaran' => $tgl_pengeluaran,
                'keterangan' => $keterangan,
                'jenis_pengeluaran' => $jenis_pengeluaran,
                'jumlah_pengeluaran' => $jumlah_pengeluaran,
            ]);
        }
    }
}
