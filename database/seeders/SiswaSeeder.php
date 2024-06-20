<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            Student::create([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'pekerjaan_orang_tua' => $faker->jobTitle,
                'pendapatan_orang_tua' => $faker->numberBetween(1000000, 50000000),
                'jumlah_tanggungan_orang_tua' => $faker->numberBetween(0, 15),
            ]);
        }
    }
}
