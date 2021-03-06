<?php

namespace ProyectoKpi\Cms\Clases;

use ProyectoKpi\Cms\Interfaces\IClases;

class Tiempo implements IClases
{
    private $hora;
    private $minuto;

    public function __construct()
    {
        $this->hora = 0;
        $this->minuto = 0;

    }

    /* Metodos */

    public function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function get($atributo)
    {
        return $this->$atributo;
    }

    public function obtenerHora($horas, $minutos)
    {

        $horaEntera = floor($minutos/60);

        if (($minutos % 60)!= 0) {
            $horaDecimal = ($minutos/60) - $horaEntera;
            $this->minuto = floor($horaDecimal * 60);
        }

        $this->hora = $horas + $horaEntera;

        return array($this->hora, $this->minuto);
    }
}
