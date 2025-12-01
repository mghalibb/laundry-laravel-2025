<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(table: 'type_of_service')->truncate();

        $now = Carbon::now();
        $services = [
            // === LAYANAN KILOAN (SESUAI UJIKOM) ===
            [
                'service_name' => 'Cuci Gosok (per Kg)',
                'price' => 5000,
                'description' => 'Cuci bersih dan gosok rapi. Perhitungan per kilogram.',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'service_name' => 'Hanya Cuci (per Kg)',
                'price' => 4500,
                'description' => 'Cuci bersih kering tanpa gosok. Perhitungan per kilogram.',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'service_name' => 'Hanya Gosok (per Kg)',
                'price' => 5000,
                'description' => 'Hanya gosok/setrika rapi. Perhitungan per kilogram.',
                'created_at' => $now, 'updated_at' => $now
            ],

            // === LAYANAN SATUAN (PAKAIAN) ===
            [
                'service_name' => 'Kemeja (per Pcs)',
                'price' => 8000,
                'description' => 'Cuci dan setrika 1 buah kemeja.',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'service_name' => 'Jaket Biasa (per Pcs)',
                'price' => 12000,
                'description' => 'Cuci dan keringkan 1 buah jaket (non-kulit/denim).',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'service_name' => 'Jas (per Pcs)',
                'price' => 25000,
                'description' => 'Perawatan khusus untuk 1 stel jas.',
                'created_at' => $now, 'updated_at' => $now
            ],

            // === LAYANAN RUMAH TANGGA ("LAUNDRY BESAR") ===
            [
                'service_name' => 'Selimut (per Pcs)',
                'price' => 15000,
                'description' => 'Cuci 1 buah selimut (single/double).',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'service_name' => 'Sprei Set (per Pcs)',
                'price' => 12000,
                'description' => 'Cuci 1 set sprei (termasuk sarung bantal/guling).',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'service_name' => 'Karpet Tipis (per m²)',
                'price' => 10000,
                'description' => 'Cuci karpet tipis, harga per meter persegi.',
                'created_at' => $now, 'updated_at' => $now
            ],
            [
                'service_name' => 'Gorden (per Kg)',
                'price' => 7000,
                'description' => 'Cuci gorden, harga per kilogram. (Sesuai harga Laundry Besar)',
                'created_at' => $now, 'updated_at' => $now
            ],

            // === LAYANAN SPESIAL ===
            [
                'service_name' => 'Dry Cleaning (per Pcs)',
                'price' => 10000,
                'description' => 'Cuci kering khusus untuk bahan sensitif.',
                'created_at' => $now, 'updated_at' => $now
            ],

            // === [BARU] LAYANAN SEPATU ===
            [
                'service_name' => 'Cuci Sepatu (per Pasang)',
                'price' => 20000, // <-- Anda bisa ganti harganya
                'description' => 'Perawatan cuci bersih untuk sneakers atau sepatu kanvas.',
                'created_at' => $now, 'updated_at' => $now
            ],
        ];

        DB::table(table: 'type_of_service')->insert(values: $services);
    }
}
