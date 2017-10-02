<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 30/09/2017
 * Time: 15:52
 */

namespace ProyectoKpi\Cms\Repositories;


use ProyectoKpi\Models\Localizaciones\Localizacion;

trait LocalizacionRepository
{
    public static function getLocalizaciones()
    {

        return Localizacion::select('localizaciones.id','localizaciones.nombre','localizaciones.direccion',
            'localizaciones.telefono','grupo_localizaciones.nombre as grupo')
            ->join('grupo_localizaciones','grupo_localizaciones.id','=','localizaciones.grupoloc_id')
            ->get();
    }
}
