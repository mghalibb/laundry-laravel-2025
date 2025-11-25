<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
// use Carbon\Carbon;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->truncate();

        $levels = [
            ['nama_level' => 'Superadmin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_level' => 'Administrator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_level' => 'Operator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama_level' => 'Leader', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('levels')->insert($levels);
    }
}
