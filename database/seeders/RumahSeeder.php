<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class RumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            $alamat = $faker->address;
            $status_rumah = $faker->randomElement(['dihuni', 'tidak_dihuni']);

            DB::table('rumahs')->insert([
                'alamat' => $alamat,
                'status_rumah' => $status_rumah,
            ]);
        }
    }
}
