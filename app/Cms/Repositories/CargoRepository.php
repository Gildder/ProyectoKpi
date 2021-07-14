<?php

namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;

trait CargoRepository
{
    public function getIndicadores(Cargo $cargo)
    {
        $result   = Cargo::findOrFail($cargo->id)->indicadores()->where('indicadores_cargos.cargo_id', '=', $cargo->id)->get();

        return $result;
    }


    public static function getsupervisores($id)
    {
        $empleadossupervisores = \DB::select('call pa_supervisores_empleadosSupervisadoresCargo('.$id.')');

        return $empleadossupervisores;
    }

}
