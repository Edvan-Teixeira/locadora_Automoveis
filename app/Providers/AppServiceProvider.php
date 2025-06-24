<?php

namespace App\Providers;

use App\Models\Financeiro;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $saldo = Financeiro::first()?->saldo_total ?? 0;
            $view->with('saldo', $saldo);
        });
    }
}
