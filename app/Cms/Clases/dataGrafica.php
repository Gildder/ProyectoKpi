<?php

namespace ProyectoKpi\Cms\Clases;


/* Inidicadores asignados a una gerencia con ponderacion y resultado de los indicadores semanalmente */

class dataGrafica
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
    public function insertarSemana($semana, $valor)
    {
        switch ($semana) {
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
                $this->semana5 = $valor;
                break;
            case 6:
                $this->semana6 = $valor;
                break;
        }
    }

}