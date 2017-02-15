<?php

namespace ProyectoKpi\Cms\Clases;

class Tiempo
{
	public function __construct()
    {

    }

	function obtenerHora($horas, $minutos)
	{
		$horaEntera = floor($minutos/60);
		$minutoResiduo = 0;

		if(($minutos % 60)!=0)
		{
			$horaDecimal = ($minutos/60) - $horaEntera;
			$minutoResiduo = floor($horaDecimal * 60);
		}

		$horaTotal = $horas + $horaEntera;

		return array($horaTotal, $minutoResiduo);
	}

}