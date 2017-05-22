<?php

namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;

class IndicadorEvaluadorRepository
{
    /*contructores */
    public function __construct()
    {
    }
    

    /* Metodos */

    /**
     * Retorn la lista de indicadores asiganados a una gerencia
     */
    public static function getIndicadorEvaluadores($evaluador_id)
    {
        $indicadores = Indicador::select('indicadores.id', 'indicadores.nombre', 'indicadores.descripcion', 'tipos_indicadores.nombre as tipo')
                ->join('evaluador_indicadores', 'evaluador_indicadores.indicador_id', '=', 'indicadores.id')
                ->join('tipos_indicadores', 'tipos_indicadores.id', '=', 'indicadores.tipo_indicador_id')
                ->where('evaluador_indicadores.evaluador_id', $evaluador_id)
                ->get();

        return $indicadores;
    }
}
