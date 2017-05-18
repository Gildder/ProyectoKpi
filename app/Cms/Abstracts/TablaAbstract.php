<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 10/05/2017
 * Time: 01:15 PM
 */

namespace ProyectoKpi\Cms\Abstracts;

use Illuminate\Support\Facades\DB;

/**
 * Tabla de Indicadores de Evaluadores
*/
abstract class  TablaAbstract
{
    protected $id;
    protected $nombre;
    protected $ponderacion;
    protected $promedio;

    /**
     * Retorna el promedio de un Indicador
    */
    public abstract function getDatosDeTablaIndicadores($indicador_id, $evaluador_id);


    /**
     * Retorna los datos de un Indicador para un Mes
     *
     * @param $evaluador
     * @param $anio
     * @param $mes
     * @param $indicador
     * @return mixed
     */
    public function cnGetIndicadoresSemana( $indicador, $evaluador, $anio, $mes)
    {
        return \DB::select('call pa_evaludados_procesosSemana(' . $evaluador . ', ' . $indicador . ', ' . $anio . ', ' . $mes . ');');
    }

    /**
     * @return mixed
     */
    public function getPromedio()
    {
        return $this->promedio;
    }


    /**
     * @return mixed
     */
    public function getPonderacion()
    {
        return $this->ponderacion;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



}