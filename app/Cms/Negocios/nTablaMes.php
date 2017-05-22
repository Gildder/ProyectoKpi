<?php

namespace ProyectoKpi\Cms\Negocios;
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 21/05/2017
 * Time: 9:12
 */

use ProyectoKpi\Cms\Clases\FiltroTabla;
use ProyectoKpi\Cms\Clases\TablaMes;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;

class nTablaMes
{

    public function __construct()
    {
        
    }
    
    /**
     * Obtener indicador por Meses indicador
    */
    public function obtenerIndicadoresDeMeses($indicador, $evaluador_id)
    {
        $inicio = \FiltroTabla::getPrimerMes();
        $fin = \FiltroTabla::getUltimoMes();
        $anio = \FiltroTabla::getAnio();

        $tabla = new TablaMes();
        $promedio = 0;

        for ($inicio; $inicio <= $fin; $inicio++)
        {
            // obtenemos las indicadores de un por semana
            $datos = EvaluadoresRepository::cnGetIndicadoresSemana($indicador->id, $evaluador_id, $anio, $inicio);

            $tabla->set($inicio, $datos[0]->promedio);

            $promedio = $promedio + $datos[0]->promedio;
        }

        $tabla->setPromedio($promedio);

        // datos del indicador
        $tabla->setId($indicador->id);
        $tabla->setNombre($indicador->nombre);
        $tabla->setPonderacion($indicador->ponderacion);


        return $tabla;
    }

    public function obtenerListaIndicadoresDeMeses($evaluador_id)
    {
        $lista = array();
        $cumplimiento = 0;
        $contador=0;

        $indicadores = EvaluadoresRepository::cnGetTotalIndicadores();

        foreach ($indicadores as $indicador)
        {
            $datos =  $this->obtenerIndicadoresDeMeses($indicador, $evaluador_id);
            $cumplimiento = $cumplimiento + $datos->getPromedio();
            $contador++;

            array_push($lista, $datos);
        }

        array_push($lista, ($cumplimiento/$contador));

        return $lista;
    }
}