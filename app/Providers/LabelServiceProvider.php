<?php

namespace ProyectoKpi\Providers;

use Illuminate\Support\ServiceProvider;
use ProyectoKpi\Cms\Clases;

class LabelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        \App::singleton('labelApps', function()
        {
            return new Clases\LabelApps();
        });
    }
}
