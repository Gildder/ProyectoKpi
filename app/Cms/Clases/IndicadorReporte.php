<?php

namespace ProyectoKpi\Cms\Clases;

/* Inidicadores asignados a una gerencia con ponderacion y resultado de los indicadores semanalmente */

use ProyectoKpi\Cms\Interfaces\IClases;
use ProyectoKpi\Cms\Interfaces\IIndicador;

/** Esta clase es para mostrar los indicadores por empleado*/
class IndicadorReporte
{
    /* Atributos */
    public $id;
    public $nombre;
    public $ponderacion;
    public $promedio;
    public $semana1;
    public $semana2;
    public $semana3;
    public $semana4;
    public $semana5;
    public $semana6;


    /*contructores */
    public function __construct()
    {
    }
}
