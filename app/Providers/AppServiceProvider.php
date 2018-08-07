<?php

namespace App\Providers;
use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        setlocale(LC_TIME, app()->getLocale());
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        
        $proxy_url    = env('PROXY_URL');
        $proxy_scheme = env('PROXY_SCHEME');

        if (!empty($proxy_url)) {
            $url->forceRootUrl($proxy_url);
        }
        if (!empty($proxy_scheme)) {
            $url->forceScheme($proxy_scheme);
        }        
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
