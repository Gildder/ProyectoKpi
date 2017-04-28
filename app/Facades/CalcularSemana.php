<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 1/05/17
 * Time: 4:31
 */

namespace ProyectoKpi\Facades;


use Illuminate\Support\Facades\Facade;

class CalcularSemana extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'calcana';
    }
}