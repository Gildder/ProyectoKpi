<?php

namespace ProyectoKpi\Cms\Clases;


/* Inidicadores asignados a una gerencia con ponderacion y resultado de los indicadores semanalmente */

use ProyectoKpi\Cms\Interfaces\Clases;

class dataGrafica implements Clases
{
    /*Atributos*/
    public $mes = 0;
    public $cantidad = 0;
    public $semana1 = 0;
    public $semana2 = 0;
    public $semana3 = 0;
    public $semana4 = 0;
    public $semana5 = 0;
    public $semana6 = 0;

    /*contructores */
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
}