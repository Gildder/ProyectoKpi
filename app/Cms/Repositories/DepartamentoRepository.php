<?php

namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Localizaciones\Departamento;

class DepartamentoRepository
{
    public function getDepartamentos()
    {
        return Departamento::
            select('departamentos.id', 'departamentos.nombre as nombre', 'grupo_departamentos.nombre as grupo')
            ->join('grupo_departamentos', 'grupo_departamentos.id', '=', 'departamentos.grupodep_id')->get();
    }
}
