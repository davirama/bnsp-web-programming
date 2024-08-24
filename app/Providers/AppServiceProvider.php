<?php

namespace App\Providers;

use App\Http\ViewComposers\AccountComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
        View::composer('layouts.main', AccountComposer::class);
        // View::composer('layouts.admin', AccountComposer::class);
    }
}
