<?php

namespace ProyectoKpi\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use ProyectoKpi\Cms\Clases\PreferenciasUsuario;
use ProyectoKpi\Cms\Clases\UsuarioActivo;

class UsuarioActivoServiceProvider extends ServiceProvider
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
        \App::bind('useract', function()
        {
            $preferencias = new PreferenciasUsuario();
            return new UsuarioActivo($preferencias);
        });
    }
}
