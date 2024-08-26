<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;

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
        //
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });
        View::share('menus', Menu::all());
    }
}
