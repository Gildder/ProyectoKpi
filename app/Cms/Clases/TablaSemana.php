<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 10/05/2017
 * Time: 01:17 PM
 */

namespace ProyectoKpi\Cms\Clases;


use ProyectoKpi\Cms\Interfaces\TablaAbstract;

class TablaSemana extends TablaAbstract
{
	/* Atributos */
    private $semana1;
    private $semana2;
    private $semana3;
    private $semana4;
    private $semana5;
    private $semana6;


    public function get($atributo)
    {
        return $this->$atributo;
    }


    /**
     * Retorna el promedio de un Indicador
     */
    public function getDatosDeTablaIndicadores($indicador_id, $evaluador_id,  $anio, $mes)
    {
        $datos = $this->cnGetIndicadoresSemana($indicador_id, $evaluador_id, $anio, $mes);

        $this->asignarPromedio($datos);
    }

    /**
     * Asignamos el Promedio a los Atributos
     */
    private function asignarPromedio($datos)
    {
        $this->semana1 = $datos[0]->semana_1;
        $this->semana2 = $datos[0]->semana_2;
        $this->semana3 = $datos[0]->semana_3;
        $this->semana4 = $datos[0]->semana_4;
        switch ($datos[0]->cantidadSemana) {
            case 5:
                $this->semana5 = $datos[0]->semana_5;
                break;
            case 6:
                $this->semana5 = $datos[0]->semana_5;
                $this->semana6 = $datos[0]->semana_6;
                break;
        }
    }
}