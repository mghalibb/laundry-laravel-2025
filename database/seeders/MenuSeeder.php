<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

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
        'url' => 'dashboard',
        'icon' => 'iconoir-report-columns',
        'category' => 'Main',
        'roles' => 'Superadmin,Administrator,Operator,Pimpinan',
        'order' => 1
    ]);

    // MASTER DATA
    Menu::create([
        'title' => 'Data User',
        'url' => 'users.index',
        'icon' => 'bi bi-person-gear',
        'category' => 'Master Data',
        'roles' => 'Superadmin,Administrator',
        'order' => 2
    ]);

    Menu::create([
        'title' => 'Data Pelanggan',
        'url' => 'customers.index',
        'icon' => 'bi bi-people',
        'category' => 'Master Data',
        'roles' => 'Superadmin,Administrator',
        'order' => 3
    ]);

    Menu::create([
        'title' => 'Jenis Layanan',
        'url' => 'services.index',
        'icon' => 'bi bi-list-check',
        'category' => 'Master Data',
        'roles' => 'Superadmin,Administrator',
        'order' => 4
    ]);

    // TRANSAKSI
    Menu::create([
        'title' => 'Transaksi Laundry',
        'url' => 'transactions.index',
        'icon' => 'bi bi-cart-plus',
        'category' => 'Transaksi',
        'roles' => 'Superadmin,Administrator,Operator',
        'order' => 5
    ]);

    Menu::create([
        'title' => 'Pengambilan',
        'url' => 'pickups.index',
        'icon' => 'bi bi-bag-check',
        'category' => 'Transaksi',
        'roles' => 'Superadmin,Administrator,Operator',
        'order' => 6
    ]);

    // LAPORAN
    Menu::create([
        'title' => 'Laporan Penjualan',
        'url' => 'reports.index',
        'icon' => 'bi bi-bar-chart',
        'category' => 'Laporan',
        'roles' => 'Superadmin,Administrator,Pimpinan',
        'order' => 7
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
