<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 10/05/2017
 * Time: 01:15 PM
 */

namespace ProyectoKpi\Cms\Interfaces;

/**
 * Tabla de Indicadores de Evaluadores
*/
abstract class  TablaAbstract
{
    protected $id;
    protected $nombre;
    protected $ponderacion;
    protected $promedio;
    protected $mesActual;
    protected $arr;

    public function __construct(array $arr)
    {
        $this->mesActual = date('n', Now());
        $this->arr = $arr;

        $this->inicializar();
    }

    public function inicializar()
    {
        $this->id = $this->arr->id;
        $this->nombre = $this->arr->nombre;
        $this->ponderacion = $this->arr->ponderacion;
        $this->promedio = $this->arr->promedio;
    }

    /**
     * Retorna el promedio de un Indicador
    */
    public abstract function getDatosDeTablaIndicadores($indicador_id, $evaluador_id, $anio, $mes);


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
        return DB::select('call pa_evaludados_procesosSemana(' . $evaluador . ', ' . $indicador . ', ' . $anio . ', ' . $mes . ');');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getPonderacion()
    {
        return $this->ponderacion;
    }

    /**
     * @return mixed
     */
    public function getPromedio()
    {
        return $this->promedio;
    }


}