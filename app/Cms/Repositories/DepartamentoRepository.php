<?php

namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\DB;
use ProyectoKpi\Models\Localizaciones\Departamento;

trait DepartamentoRepository
{
    public static function getDepartamentos()
    {
        return Departamento::
            select('departamentos.id', 'departamentos.nombre as nombre', 'grupo_departamentos.nombre as grupo')
            ->join('grupo_departamentos', 'grupo_departamentos.id', '=', 'departamentos.grupodep_id')->get();
    }

    public static function getsupervisores($id)
    {
        $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresDepartamento('.$id.')');

        return $empleadossupervisores;
    }
}
