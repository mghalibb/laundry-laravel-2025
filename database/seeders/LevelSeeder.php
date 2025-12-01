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

        // $levels = [
        //     ['nama_level' => 'Superadmin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['nama_level' => 'Administrator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['nama_level' => 'Operator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['nama_level' => 'Leader', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ];

        $levels = [
            [
                'nama_level' => 'Superadmin',
                'description' => 'Has full access to all system modules and user management.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_level' => 'Administrator',
                'description' => 'Manages all master data (Customers, Services, Inventory). Cannot manage users.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_level' => 'Operator',
                'description' => 'Handles day-to-day transactions and laundry pickups.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_level' => 'Leader',
                'description' => 'Views all reports (Sales, Profit/Loss, Stock) and can download them.',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama_level' => 'Customer',
                'description' => 'An individual or organization that has or has the potential to purchase goods or services from a business.',
                'status' => 'Inactive',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('levels')->insert($levels);
    }
}
