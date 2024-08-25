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
        View::composer('peserta.dashboard', AccountComposer::class);
        View::composer('peserta.formpendaftaran', AccountComposer::class);
        View::composer('peserta.detail', AccountComposer::class);
        View::composer('admin.dashboard', AccountComposer::class);
    }
}
