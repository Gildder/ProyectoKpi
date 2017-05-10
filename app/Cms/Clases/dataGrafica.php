<?php

namespace ProyectoKpi\Cms\Clases;


/* Inidicadores asignados a una gerencia con ponderacion y resultado de los indicadores semanalmente */

use ProyectoKpi\Cms\Interfaces\IClases;

class DataGrafica implements IClases
{
    /*Atributos*/
    private $mes;
    private $cantidad;
    private $promedio;
    private $semanas = array();

    /* Contructores */
    public function __construct()
    {
        
    }

    /* Metodos */
    public function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function get($atributo){
        return $this->$atributo;
    }

    public function setSemanas($semana, $valor)
    {
        array_push($semas, new SemanaIndicador($semana, $valor) );
    }

    
}