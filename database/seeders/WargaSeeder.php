<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            $nama = $faker->name;
            $ktp = $faker->randomNumber(9, true);
            $status = $faker->randomElement(['tetap', 'kontrak']);
            $no_telp = $faker->phoneNumber;
            $status_menikah = $faker->randomElement(['Sudah', 'Belum']);
            $tgl_bergabung = $faker->dateTimeBetween('2020-01-01', '2024-12-31')->format('Y-m-d')

            DB::table('wargas')->insert([
                'nama' => $nama,
                'ktp' => $ktp,
                'status' => $status,
                'no_telp' => $no_telp,
                'status_menikah' => $status_menikah,
                'tgl_bergabung' => $tgl_bergabung,
            ]);
        }
    }
}
