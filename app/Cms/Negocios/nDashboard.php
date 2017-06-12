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
    private $indicadores;
    private $evaluador;
    private $tablaSemana;
    private $tablaMes;

    public function __construct()
    {
        $this->evaluador = \Cache::get('evadores');
        $this->tablaSemana = new nTablaSemana();
        $this->tablaMes = new nTablaMes();
        $this->indicadores = EvaluadoresRepository::cnGetTotalIndicadores($this->evaluador->id);

    }

    /**
     * Obtener los tipo de insicadores con su ponderacion de evaluacion
     *
    */
    public function obtenerPondTiposIndicadores()
    {
        return EvaluadoresRepository::cnGetPonderacionTipoIndicadores($this->evaluador->id);
    }

    /**
     * Obtener las ponderacion de las escalas de cumplimiento
    */
    public function obtenerPondEscalas()
    {
        return EvaluadoresRepository::cnGetLimitesEscalas($this->evaluador->id);
    }

    public function obtenerListaTablaSemana()
    {
        return  $this->tablaSemana->obtenerListaIndicadoresDeMes($this->indicadores, $this->evaluador->id);
    }

    public function obtenerListaTablaMes()
    {
        return $this->tablaMes->obtenerListaIndicadoresDeMeses($this->indicadores, $this->evaluador->id);
    }

    public function obtenerListaChartSemana()
    {
        return  $this->tablaSemana->obtenerChartMes($this->indicadores, $this->evaluador->id);
    }

    public function obtenerListaChartMes()
    {
        return $this->tablaMes->obtenerChartMes($this->indicadores, $this->evaluador->id);
    }

    /**
     * Obtener la lista de Opciones para crear Widget en el DashBoard
     *
     * @return array
     */
    public function obtenerListaItemWidget()
    {
        $lista = array();

        $tipo1 = new \stdClass();
        $tipo1->id = 1;
        $tipo1->titulo = 'Tipos de Procesos';
        $tipo1->descripcion = 'Permite crear un widget de los Tipos de Indicadores.';

        array_push($lista, $tipo1);

        $tipo2 = new \stdClass();
        $tipo2->id = 2;
        $tipo2->titulo = 'Empleados';
        $tipo2->descripcion = 'Permite crear un widget de los empleados evaluados.';

        array_push($lista, $tipo2);

        $tipo3 = new \stdClass();
        $tipo3->id = 3;
        $tipo3->titulo = 'Tareas';
        $tipo3->descripcion = 'Permite crear un widget de las Tareas realizadas.';

        array_push($lista, $tipo3);

        return $lista;

    }

}