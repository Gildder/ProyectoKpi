<?php

namespace ProyectoKpi\Providers;

use Illuminate\Support\ServiceProvider;
use ProyectoKpi\Cms\Clases\FiltroTabla;

class FiltroTablaServiceProvider extends ServiceProvider
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
        \App::singleton('filtroTabla', function()
        {
            return new FiltroTabla();
        });
    }
}
