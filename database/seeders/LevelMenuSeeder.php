<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;
use App\Models\Menu;

class LevelMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Level::find(1);
        $administrator = Level::find(2);
        $operator = Level::find(3);
        $leader = Level::find(4);

        $menus = Menu::all();

        foreach ($menus as $menu) {
            $rolesArray = explode(',', $menu->roles);

            if (in_array('Superadmin', $rolesArray) && $superadmin) {
                $superadmin->menus()->attach($menu->id);
            }
            
            if (in_array('Administrator', $rolesArray) && $administrator) {
                $administrator->menus()->attach($menu->id);
            }

            if (in_array('Operator', $rolesArray) && $operator) {
                $operator->menus()->attach($menu->id);
            }

            if (in_array('Leader', $rolesArray) && $leader) {
                $leader->menus()->attach($menu->id);
            }
        }
    }
}
