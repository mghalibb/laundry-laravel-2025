<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // DASHBOARD
    Menu::create([
        'title' => 'Dashboard',
        'url' => 'index',
        'icon' => 'iconoir-report-columns menu-icon',
        'category' => 'Main',
        'roles' => 'Superadmin,Administrator,Operator,Leader,Customer',
        'order' => 1
    ]);
    // DASHBOARD

    // MASTER DATA
    Menu::create([
        'title' => 'Data User',
        'url' => 'users.index',
        'icon' => 'bi bi-person-gear menu-icon',
        'category' => 'Master Data',
        'roles' => 'Superadmin,Administrator',
        'order' => 2
    ]);
    
    Menu::create([
        'title' => 'Data Lavel',
        'url' => 'levels.index',
        'icon' => 'bi bi-shield-check menu-icon',
        'category' => 'Master Data',
        'roles' => 'Superadmin,Administrator',
        'order' => 3
    ]);

    Menu::create([
        'title' => 'Data Pelanggan',
        'url' => 'customers.index',
        'icon' => 'bi bi-people menu-icon',
        'category' => 'Master Data',
        'roles' => 'Superadmin,Administrator',
        'order' => 4
    ]);

    Menu::create([
        'title' => 'Jenis Layanan',
        'url' => 'services.index',
        'icon' => 'bi bi-list-check menu-icon',
        'category' => 'Master Data',
        'roles' => 'Superadmin,Administrator',
        'order' => 5
    ]);

    // TRANSAKSI
    Menu::create([
        'title' => 'Transaksi Laundry',
        'url' => 'transactions.index',
        'icon' => 'bi bi-cart-plus menu-icon',
        'category' => 'Transaksi',
        'roles' => 'Superadmin,Administrator,Operator',
        'order' => 6
    ]);

    Menu::create([
        'title' => 'Pengambilan',
        'url' => 'pickups.index',
        'icon' => 'bi bi-bag-check menu-icon',
        'category' => 'Transaksi',
        'roles' => 'Superadmin,Administrator,Operator',
        'order' => 7
    ]);

    // LAPORAN
    Menu::create([
        'title' => 'Laporan Penjualan',
        'url' => 'reports.index',
        'icon' => 'bi bi-bar-chart menu-icon',
        'category' => 'Laporan',
        'roles' => 'Superadmin,Administrator,Pimpinan',
        'order' => 8
    ]);

    // MANAJEMEN MENU
    Menu::create([
        'title' => 'Manajemen Menu',
        'url' => 'menus.index',
        'icon' => 'bi bi-gear menu-icon',
        'category' => 'Pengaturan',
        'roles' => 'Superadmin,Administrator',
        'order' => 99
    ]);
    }
}
