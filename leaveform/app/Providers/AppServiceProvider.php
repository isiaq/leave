<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {


        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Laravel wahala: https://github.com/laravel/framework/issues/35241
        $app_url = \Config::get('app.url');
        $check = strstr($app_url, 'https://');
        \URL::forceRootUrl($app_url);
        if($check) \URL::forceScheme('https');

        Schema::defaultStringLength(191);
    }
}
