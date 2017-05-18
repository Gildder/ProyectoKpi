<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 10/05/2017
 * Time: 01:17 PM
 */

namespace ProyectoKpi\Cms\Clases;


use ProyectoKpi\Cms\Abstracts\TablaAbstract;

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


    public function __construct($id, $nombre, $ponderacion, $evaluador)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ponderacion = $ponderacion;

        $this->getDatosDeTablaIndicadores($id, $evaluador);
    }

    public function get($atributo)
    {
        return $this->$atributo;
    }

    /**
     * Retorna el promedio de un Indicador
     */
    public function getDatosDeTablaIndicadores($indicador_id, $evaluador_id)
    {
        $promedio  = 0;
        $ultimoMes = \FiltroTabla::getUltimoMes();
        $anio      = \FiltroTabla::getAnio();
        $primerMes = \FiltroTabla::getPrimerMes() - 1;

        // recorremos los meses desde una mes de inicio y fin
        while ($primerMes <= $ultimoMes)
        {
            $primerMes++;
            $datos = $this->cnGetIndicadoresSemana($indicador_id, $evaluador_id, $anio, $primerMes);

            $this->asignarPromedio($primerMes, $datos[0]->promedio);
            $promedio = $promedio + $datos[0]->promedio;

        }

        // Calculamos el Promedio de de los meses
        $this->calcularPromedio($promedio, $primerMes);
    }

    /**
     * Asignamos el Promedio a cada uno de los meses
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

    public function getMes($mes)
    {
        switch ($mes)
        {
            case 1:
                return $this->ene;
                break;
            case 2:
                return $this->feb;
                break;
            case 3:
                return $this->mar;
                break;
            case 4:
                return $this->abr;
                break;
            case 5:
                return $this->may;
                break;
            case 6:
                return $this->jun;
                break;
            case 7:
                return $this->jul;
                break;
            case 8:
                return $this->ago;
                break;
            case 9:
                return $this->sep;
                break;
            case 10:
                return $this->oct;
                break;
            case 11:
                return $this->nov;
                break;
            default:
                return $this->dic;
                break;
        }
    }

    /**
     * @param $promedio
     * @param $primerMes
     */
    private function calcularPromedio($promedio, $primerMes)
    {
        $this->promedio = $promedio / $primerMes;
    }
}