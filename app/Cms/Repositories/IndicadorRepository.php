<?php

namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

use ProyectoKpi\Cms\Clases\IndicadorPersonal;
use ProyectoKpi\Cms\Interfaces\IIndicador;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Cms\Repositories\EficaciaIndicadorRepository;
use ProyectoKpi\Cms\Repositories\EficienciaIndicadorRepository;

class IndicadorRepository
{
    /*contructores */
    public function __construct()
    {
    }


    /* Metodos */

    /**
     * Retorn la lista de indicadores para un Empleado
     * @param $codigo
     * @return
     */
    public static function cnGetListaInidicadores($codigo)
    {
        return Empleado::select('indicadores.id', 'indicadores.nombre', 'indicadores.orden', 'indicadores.descripcion', 'tipos_indicadores.nombre as tipo',
            'indicador_cargos.objetivo', 'indicador_cargos.condicion', 'indicador_cargos.aclaraciones', 'frecuencias.nombre as freciencia')
                ->join('indicador_cargos', 'indicador_cargos.cargo_id', '=', 'empleados.cargo_id')
                ->join('indicadores', 'indicadores.id', '=', 'indicador_cargos.indicador_id')
                ->join('tipos_indicadores', 'tipos_indicadores.id', '=', 'indicadores.tipo_indicador_id')
                ->join('frecuencias', 'frecuencias.id', '=', 'indicador_cargos.frecuencia_id')
                ->where('empleados.codigo', $codigo)
                ->get();

//        return Indicador::all('')
    }


    /**
     * Lista d eindicadores asignado a Gerencia evaluadora
     *
     * @param  id de Indicador
     */
    public static function cnGetIndicadoresDeEvaluadores($evaluador_id)
    {
        $result = DB::table('indicadores i')
            ->join('evalaudor_indicadores ei', 'ei.indicador_id', '=', 'i.id')
            ->join('tipos_indicadores ti', 'ti.id', '=', 'i.tipo_indicador_id')
            ->where('ei.evaluador_id', $evaluador_id)
            ->select('i.id', 'i.nombre', 'i.descripcion', 'ti.nombre as tipo')
            ->get();

        return json_encode($result);
    }

    /**
     * @param $cargo_id
     * @return mixed
     */
    public static function cnCamtidadEmpleados($cargo_id)
    {
        return \DB::table('indicador_cargos')->select('indicador_cargos.cargo_id')
            ->where('indicador_cargos.cargo_id', $cargo_id)
            ->count();
    }


    /**
     * Obtener los numeros del Orden ocupados
     */
    public static function cnNroOrdenOcupadas()
    {
        return DB::table('indicadores')->select('indicadores.orden')->get();
    }
    /**
     * Verifica si un indicador esta asignado a cargo
     * 
     * @param  id de Indicador
     * @param  id de Cargo
     * @return boolean
     */
    public static function isUserIndicador($cargo_id)
    {
        $result = self::cnCamtidadEmpleados($cargo_id);

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getTablaIndicador($empleado_id, $indicador_id)
    {
        $indicador = self::getIndicador($empleado_id, $indicador_id);

        return $indicador->getTablas($empleado_id);
    }

    public static function getGraficoIndicador($empleado_id, $indicador_id)
    {
        $indicador = self::getIndicador($empleado_id, $indicador_id);

        return $indicador->getChart($empleado_id);
    }

    /**
     * @param $indicador_id
     * @return IndicadorPersonal
     */
    public static function getIndicador($empleado_id, $indicador_id)
    {
        switch ($indicador_id) {
            case 1:
                $indicador = new IndicadorPersonal(new EficaciaIndicadorRepository($empleado_id));
                break;
            case 2:
                $indicador = new IndicadorPersonal(new EficienciaIndicadorRepository($empleado_id));
                break;
        }
        return $indicador;
    }
}
