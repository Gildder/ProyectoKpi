<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 08/05/2017
 * Time: 03:35 PM
 */

namespace ProyectoKpi\Cms\Clases;

use ProyectoKpi\Cms\Interfaces\IClases;

class FiltroEvaluadores implements IClases
{
    private $vista; // semanal = 1; mensual = 0
    private $fechaInicio;
    private $fechaFin;

    public function __construct()
    {
        $this->vista = 1;
        $this->fechaInicio = now();
        $this->fechaFin = now();
    }

    public function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function get($atributo)
    {
        return $this->$atributo;
    }
}
