<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 21/05/2017
 * Time: 18:38
 */

namespace ProyectoKpi\Cms\Negocios;


use Illuminate\Http\Response;
use ProyectoKpi\Cms\Clases\FiltroTabla;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;

class nDashboard
{
    public function __construct()
    {
    }

    /**
     * Obtener los tipo de insicadores con su ponderacion de evaluacion
     *
    */
    public function obtenerPondTiposIndicadores()
    {
        $evaluador = \Cache::get('evadores');
        return EvaluadoresRepository::cnGetPonderacionTipoIndicadores($evaluador->id);
    }

    /**
     * Obtener las ponderacion de las escalas de cumplimiento
    */
    public function obtenerPondEscalas()
    {
        $evaluador = \Cache::get('evadores');
        return EvaluadoresRepository::cnGetLimitesEscalas($evaluador->id);
    }

    /**
     * @param FiltroTabla $filtro
     * @return string
     */
    public function obtenerListaTablaSemana()
    {
        $tablaSemana = new nTablaSemana();
        $evaluador = \Cache::get('evadores');

        return  $tablaSemana->obtenerListaIndicadoresDeMes($evaluador->id);

    }

    /**
     * @param FiltroTabla $filtro
     * @return string
     */
    public function obtenerListaTablaMes()
    {
        $tablaMes = new nTablaMes();
        $evaluador = \Cache::get('evadores');

        return $tablaMes->obtenerListaIndicadoresDeMeses($evaluador->id);
    }

    public function obtenerTablaIndicadorTotal()
    {
        $evaluador = \Cache::get('evadores');
        return Response::json(
            EvaluadoresRepository::cnGetTotalIndicadores($evaluador->id)
        );
    }
}