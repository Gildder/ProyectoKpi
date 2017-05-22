<?php

namespace ProyectoKpi\Cms\Negocios;
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 21/05/2017
 * Time: 9:12
 */

use ProyectoKpi\Cms\Clases\FiltroTabla;
use ProyectoKpi\Cms\Clases\Indicador;
use ProyectoKpi\Cms\Clases\TablaSemana;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;

class nTablaSemana
{

    public function __construct()
    {
    }

    /**
     * Obtener los indicadores de un mes por semana
    */
    public function obtenerIndicadorDeMes($indicador, $evaluador_id)
    {
        $anio = \FiltroTabla::getAnio();
        $mesBuscado = \FiltroTabla::getMesBuscado();

        $datos = EvaluadoresRepository::cnGetIndicadoresSemana($indicador->id, $evaluador_id, $anio, $mesBuscado);

        $tabla = new TablaSemana();
        $tabla->setSemana1($datos[0]->semana_1);
        $tabla->setSemana2($datos[0]->semana_2);
        $tabla->setSemana3($datos[0]->semana_3);
        $tabla->setSemana4($datos[0]->semana_4);
        switch ($datos[0]->cantidadSemana) {
            case 5:
                $tabla->setSemana5($datos[0]->semana_5);
                break;
            case 6:
                $tabla->setSemana5($datos[0]->semana_5);
                $tabla->setSemana6($datos[0]->semana_6);
                break;
        }
        $tabla->setSemanas($datos[0]->cantidadSemana);
        $tabla->setPromedio($datos[0]->promedio );

        // datos del indicador
        $tabla->setId($indicador->id);
        $tabla->setNombre($indicador->nombre);
        $tabla->setPonderacion($indicador->ponderacion);

        return $tabla;
    }

    /**
     * Obtener Lista de indicadores de un mes por semanas
    */
    public function obtenerListaIndicadoresDeMes($evaluador_id)
    {
        $lista = array();
        $cumplimiento = 0;
        $contador = 0;

        $indicadores = EvaluadoresRepository::cnGetTotalIndicadores();
        foreach ($indicadores as $indicador)
        {
            $datos =  $this->obtenerIndicadorDeMes( $indicador, $evaluador_id) ;
            $cumplimiento = $cumplimiento + $datos->getPromedio();
            $contador++;

            array_push($lista, $datos);
        }

        array_push($lista, ($cumplimiento/$contador));

        return $lista;
    }
    
}
