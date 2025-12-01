<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Facade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ghalib',
            'username' => 'ghalib123',
            'email' => 'ghalib123@gmail.com',
            'password' => Hash::make('admin123'),
            'id_level' => 1,
        ]);

        User::create([
            'name' => 'Heavy Luck',
            'username' => 'heavyluck123',
            'email' => 'heavyluck123@gmail.com',
            'password' => Hash::make('admin123'),
            'id_level' => 1,
        ]);

        User::create([
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'administrator123@gmail.com',
            'password' => Hash::make('admin123'),
            'id_level' => 2,
        ]);

        User::create([
            'name' => 'Operator Laundry',
            'username' => 'operator',
            'email' => 'operator123@gmail.com',
            'password' => Hash::make('admin123'),
            'id_level' => 3,
        ]);

        User::create([
            'name' => 'Juragan Laundry',
            'username' => 'owner',
            'email' => 'owner123@gmail.com',
            'password' => Hash::make('admin123'),
            'id_level' => 4,
        ]);
    }
}
