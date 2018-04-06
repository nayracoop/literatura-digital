<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, app()->getLocale());
        date_default_timezone_set('America/Argentina/Buenos_Aires');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
