<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PembayaranIuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();


        for ($i = 0; $i < 50; $i++) {
            $PenghuniRumah_id = $faker->numberBetween(1, 50);
            $tgl_pembayaran = $faker->dateTimeBetween('2020-01-01', '2024-12-31')->format('Y-m-d')
            $jenis_iuran = $faker->randomElement(['satpam', 'kebersihan']);
            $periode_bayar = $faker->randomElement(['bulan', 'tahun']);
            $jumlah_iuran = $faker->randomFloat(2, 1000, 100000);
            $status_pembayaran = $faker->randomElement(['lunas', 'belum']);

            DB::table('pembayaran_iurans')->insert([
                'PenghuniRumah_id' => $PenghuniRumah_id,
                'tgl_pembayaran' => $tgl_pembayaran,
                'jenis_iuran' => $jenis_iuran,
                'periode_bayar' => $periode_bayar,
                'jumlah_iuran' => $jumlah_iuran,
                'status_pembayaran' => $status_pembayaran,
            ]);
        }
    }
}
