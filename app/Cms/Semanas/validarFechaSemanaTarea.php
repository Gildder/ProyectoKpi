<?php

namespace ProyectoKpi\Cms\Semanas;


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use ProyectoKpi\Cms\Clases\Caches;

trait validarFechaSemanaTarea
{
    public static function validarFormatoFecha($fecha){
        if(\Calcana::validarFormatoEuropeo($fecha)){
            return true;
        } else {
            return false;
        }
    }

    public static function validarFechaLimiteTarea($fecha)
    {
        $inicioSemana = Caches::obtener('inicioSemana');
        $finSemana = Caches::obtener('finSemana');

        if(\Calcana::validarFormatoEuropeo($fecha)){
            $fecha = \Calcana::cambiarFormatoDB($fecha);
        }

        if(\Calcana::validarFormatoEuropeo($inicioSemana)){
            $inicioSemana = \Calcana::cambiarFormatoDB($inicioSemana);
        }

        if(\Calcana::validarFormatoEuropeo($finSemana)){
            $finSemana = \Calcana::cambiarFormatoDB($finSemana);
        }

        $fechaBuscada = Carbon::parse($fecha);
        $fechaInicio = Carbon::parse($inicioSemana);
        $fechaFin = Carbon::parse($finSemana);

        if($fechaBuscada->gte($fechaInicio) && $fechaBuscada->lte($fechaFin))
        {
            return true;
        }else{
            return false;
        }

    }

    public static function validarFechaFormato($fecha)
    {
        $fechaEU = explode("/", $fecha);

        try {
            if (sizeof($fechaEU) == 3) {
                $fechaInicioParse = Carbon::create($fechaEU[2], $fechaEU[1], $fechaEU[0]);
                return true;
            }else{
                return false;
            }

        }catch (\Exception $ex){
            return false;
        }


    }

    public static function validarMayorIgual($fechaInicio, $fechaFin)
    {
        if(\Calcana::validarFormatoEuropeo($fechaInicio)){
            $fechaInicio = \Calcana::cambiarFormatoDB($fechaInicio);
        }

        if(\Calcana::validarFormatoEuropeo($fechaFin)){
            $fechaFin = \Calcana::cambiarFormatoDB($fechaFin);
        }


        $inicioFecha = Carbon::parse($fechaInicio);
        $finFecha = Carbon::parse($fechaFin);

        if($inicioFecha->lte($finFecha))
        {
            return true;
        }else{
            return false;
        }
    }

    public static function validarDuracionCeros($hora, $minuto)
    {
        if((integer) $hora == 0 && (integer) $minuto == 0){
            return false;
        }else{
            return true;
        }
    }


}
