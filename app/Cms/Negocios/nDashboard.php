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
use ProyectoKpi\Cms\Clases\Tabla;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Models\Evaluadores\Widget;

class nDashboard
{
    private $indicadores;
    private $evaluador;
    private $tablaSemana;
    private $tablaMes;

    public function __construct()
    {
        $this->evaluador = \Cache::get('evadores');
    }

    /**
     * Permite obtener los datos de la tabla segun el tipo de Widget
     *
     * @param $widget
     */
    public function obtenerDatosTabla(Widget $widget)
    {
        $datosTabla=null;
        $dar = Widget::findOrFail($widget->id);

        if($widget->isSemanal == 0 ){
            $datosTabla = new nTablaSemana($dar);
        }else{
            $datosTabla = new nTablaMes($dar);
        }

        return $datosTabla->obtenerDatosTabla();
    }

    /**
     * Permite obtener los datos de la tabla segun el tipo de Widget
     *
     * @param $widget
     */
    public function obtenerDatosChart(Widget $widget)
    {
        $datosTabla=null;
        if($widget->isSemanal == 0 ){
            $datosTabla = new nTablaSemana($widget);
        }else{
            $datosTabla = new nTablaMes($widget);
        }

        return $datosTabla->obtenerDatosChart();
    }

    //***********************************************************

    public function obtenerDatosSgteAntSemana(Widget $widget)
    {

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

    /**
     * Retorna lista de indicadores por semana por Tipo Indicador
     *
     *
     * @return array
     */
    public function obtenerTablaTipoIndicadorSemana()
    {
        return  $this->tablaSemana->datosTipoIndicadorTabla($this->indicadores, $this->evaluador->id);
    }

    /**
     * Obtener Lista de Indicadores de Eficacia por Tipo de Indicadores
     *
     * @return array
     *
     */
    public function obtenerTablaTipoIndicadorMes()
    {
        return $this->tablaMes->datosTipoIndicadorTabla();
    }

    public function obtenerListaChartSemana()
    {
        return  $this->tablaSemana->datosTipoIndicadorChart($this->indicadores, $this->evaluador->id);
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
        $tipo1->titulo = 'Tipos de Indicadores';
        $tipo1->descripcion = 'Permite crear un widget de los Tipos de Indicadores.';

        array_push($lista, $tipo1);

        $tipo2 = new \stdClass();
        $tipo2->id = 2;
        $tipo2->titulo = 'Usuarios';
        $tipo2->descripcion = 'Permite crear un widget de los empleados evaluados.';

        array_push($lista, $tipo2);

        $tipo3 = new \stdClass();
        $tipo3->id = 3;
        $tipo3->titulo = 'Semanas';
        $tipo3->descripcion = 'Permite crear un widget de las Tareas realizadas.';

        array_push($lista, $tipo3);

        return $lista;

    }

    public function obtenerDatosWidget($tipoWidget)
    {

    }

    public function obtenerTiposIndicadores()
    {
        return EvaluadoresRepository::getListaTiposIndicadores($this->evaluador->id);
    }

    public function obtenerIndicadores()
    {
        return EvaluadoresRepository::getListaIndicadores($this->evaluador->id);
    }

    public function obtenerEvaluadorWidget()
    {
        return EvaluadoresRepository::getEvaluadorWidget( \Cache::get('evadores')->id, \Usuario::get('id') );
    }

    public function obtenerCantidadSemana($mes)
    {
        return EvaluadoresRepository::getObtenerCantidadSemanas($mes);
    }

    public function obtenerfechasSemana($mes)
    {
        // imcompleto repositorio
        return EvaluadoresRepository::getObtenerFechasemanas($mes);
    }

    public function eliminarEvaluadorWidget($id)
    {
        return EvaluadoresRepository::deleteEvaluadorWidget($id);
    }



}

