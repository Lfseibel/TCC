<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        //
        app()->setLocale('pt_BR');

        if(env(key: 'APP_ENV') != 'local')
        {
            URL::forceScheme( scheme: 'https');
        }
    }
}
