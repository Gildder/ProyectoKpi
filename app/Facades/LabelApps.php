<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 07/05/2017
 * Time: 15:05
 */

namespace ProyectoKpi\Facades;


use Illuminate\Support\Facades\Facade;

class LabelApps extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'labelApps';
    }
}