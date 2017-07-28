<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 24/07/2017
 * Time: 07:46 PM
 */

namespace ProyectoKpi\Cms\Clases;


class Caches
{
    public static function guardar($clave, $valor)
    {
        \Cache::forget($clave);
        \Cache::forever($clave, $valor);
    }

    public static function obtener($clave)
    {
        $valor = \Cache::get($clave);
        return $valor;
    }

    public static function borrar($clave)
    {
        \Cache::forget($clave);
    }
}
