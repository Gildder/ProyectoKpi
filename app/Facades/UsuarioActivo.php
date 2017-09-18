<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 28/04/17
 * Time: 9:10
 */

namespace ProyectoKpi\Facades;


use Illuminate\Support\Facades\Facade;

class UsuarioActivo extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'useract';
    }
}
