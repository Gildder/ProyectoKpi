<?php

namespace ProyectoKpi\Cms\Clases;

/* Inidicadores asignados a una gerencia con ponderacion y resultado de los indicadores semanalmente */

use ProyectoKpi\Cms\Interfaces\IClases;
use ProyectoKpi\Cms\Interfaces\IIndicador;

/** Esta clase es para mostrar los indicadores por empleado*/
class IndicadorPersonal implements Iclases, IIndicador
{
    private $indicador;

    /*Atributos*/
    private $id;
    private $gestion;
    private $mes;
    private $semana;
    private $tipo;
    private $dataSemana;


    /*contructores */
    public function __construct(IIndicador $indicador)
    {
        $this->indicador = $indicador;
    }

    /* Metodos */
    public function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function get($atributo)
    {
        return $atributo;
    }

    public function getTablas($empleado_id)
    {
        return $this->indicador->getTablas($empleado_id);
    }

    public function getChart($empleado_id)
    {
        return $this->indicador->getChart($empleado_id);
    }

}