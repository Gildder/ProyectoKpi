<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 10/05/2017
 * Time: 01:17 PM
 */

namespace ProyectoKpi\Cms\Clases;


use ProyectoKpi\Cms\Interfaces\TablaAbstract;

class TablaMes extends TablaAbstract
{
    /* Atributos */
    private $ene;
    private $feb;
    private $mar;
    private $abr;
    private $may;
    private $jun;
    private $jul;
    private $ago;
    private $sep;
    private $oct;
    private $nov;
    private $dic;


    public function get($atributo)
    {
        return $this->$atributo;
    }


    /**
     * Retorna el promedio de un Indicador
     */
    public function getDatosDeTablaIndicadores($indicador_id, $evaluador_id,  $anio, $mes)
    {
        while ($mes < $this->mesActual)
        {
            $datos = $this->cnGetIndicadoresSemana($indicador_id, $evaluador_id, $anio, $mes);

            $this->asignarPromedio($mes, $datos[0]->promedio);
        }
    }

    /**
     * Asignamos el Promedio a los Atributos
    */
    private function asignarPromedio($mes, $promedio)
    {
        switch ($mes)
        {
            case 1:
                $this->ene = $promedio;
                break;
            case 2:
                $this->feb = $promedio;
                break;
            case 3:
                $this->mar = $promedio;
                break;
            case 4:
                $this->abr = $promedio;
                break;
            case 5:
                $this->may = $promedio;
                break;
            case 6:
                $this->jun = $promedio;
                break;
            case 7:
                $this->jul = $promedio;
                break;
            case 8:
                $this->ago = $promedio;
                break;
            case 9:
                $this->sep = $promedio;
                break;
            case 10:
                $this->oct = $promedio;
                break;
            case 11:
                $this->nov = $promedio;
                break;
            default:
                $this->dic = $promedio;
                break;
        }
    }
}