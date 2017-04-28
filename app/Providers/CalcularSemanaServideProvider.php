<?php

namespace ProyectoKpi\Providers;

use Illuminate\Support\ServiceProvider;
use ProyectoKpi\Cms\Clases\CalcularSemana;

class CalcularSemanaServideProvider extends ServiceProvider
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
        \App::singleton('calcana', function()
        {
            return new CalcularSemana();
        });
    }
}
