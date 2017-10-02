<?php
namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Tareas\Estados;

/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 30/09/2017
 * Time: 15:10
 */
trait EstadoRepository
{
    public static function getEstados()
    {
        return Estados::select('estado_tareas.id', 'estado_tareas.nombre')
            ->get();
    }

}
