<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if (isSecure() && env('FORCE_HTTPS', false)) {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS','on');
        }
    }
}
