<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.partials.startbar', function ($view) {
            $user = Auth::user();
            if (!$user) {
                return;
            }

            $menus = Menu::where('is_active', true)
                ->whereHas('levels', function($query) use ($user) {
                    $query->where('id_level', $user->id_level);
                })
                ->orderBy('order', 'ASC')
                ->get()
                ->groupBy('category');

            $sortedMenus = $menus->sortBy(function ($items) {
                return $items->min('order');
            });
        
            $view->with('menus', $sortedMenus);
        });
    }
}
