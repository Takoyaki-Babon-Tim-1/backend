<?php

namespace App\Providers;

use App\Models\AddToCart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $cartItemCount = AddToCart::where('user_id', Auth::id())->sum('quantity');
                $view->with('cartItemCount', $cartItemCount);
            } else {
                $view->with('cartItemCount', 0);
            }
        });
    }
}
