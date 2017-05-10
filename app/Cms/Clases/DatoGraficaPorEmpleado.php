<?php

namespace ProyectoKpi\Cms\Clases;


/* Inidicadores asignados a una gerencia con ponderacion y resultado de los indicadores semanalmente */

use ProyectoKpi\Cms\Interfaces\IClases;
use ProyectoKpi\Cms\Interfaces\IDataIndicador;

class DatoGraficaPorEmpleado implements IClases,  IDataIndicador
{
    /*Atributos*/
    private $gestion;
    private $mes;
    private $semana1;
    private $semana2;
    private $semana3;
    private $semana4;
    private $semana5;
    private $semana6;
    private $semanas;

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

    public function setValor($data, $valor)
    {
        switch ($data) {
            case 1:
                $this->semana1 = $valor;
                break;
            case 2:
                $this->semana2 = $valor;
                break;
            case 3:
                $this->semana3 = $valor;
                break;
            case 4:
                $this->semana4 = $valor;
                break;
            case 5:
                $this->semana5 =  $valor;
                break;
            default:
                $this->semana6 = $valor;
                break;
        }
    }

    public function getValor($data)
    {
        // TODO: Implement getValor() method.
    }
}