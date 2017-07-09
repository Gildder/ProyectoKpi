<?php

namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;

class CargoRepository
{
    public function getIndicadores(Cargo $cargo)
    {
        $result   = Cargo::findOrFail($cargo->id)->indicadores()->where('indicadores_cargos.cargo_id', '=', $cargo->id)->get();

        return $result;
    }
}
