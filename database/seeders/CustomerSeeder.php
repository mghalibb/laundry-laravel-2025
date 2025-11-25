<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Ibu Susi Susanti',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'tlp' => '081234567890',
                'jk' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bapak Budi Santoso',
                'alamat' => 'Jl. Sudirman Kav. 50, Jakarta Selatan',
                'tlp' => '081398765432',
                'jk' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mbak Rina Nose',
                'alamat' => 'Gang Kelinci No. 3, Jakarta Barat',
                'tlp' => '081812345678',
                'jk' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mas Tukul Arwana',
                'alamat' => 'Komplek Empang Bahagia, Jakarta Utara',
                'tlp' => '087711223344',
                'jk' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ibu Megawati',
                'alamat' => 'Jl. Kebagusan Raya, Jakarta Selatan',
                'tlp' => '085655667788',
                'jk' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Customer::insert($data);
        /*
        $faker = \Faker\Factory::create('id_ID'); // Pakai bahasa Indonesia
        for ($i = 0; $i < 10; $i++) {
            Customer::create([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'tlp' => $faker->phoneNumber,
                'jk' => $faker->randomElement(['L', 'P']),
            ]);
        }
        */
    }
}
