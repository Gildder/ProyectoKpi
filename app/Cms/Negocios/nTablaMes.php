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

    public function obtenerListaIndicadoresDeMeses($indicadores,$evaluador_id)
    {
        $lista = array();
        $cumplimiento = 0;
        $contador=0;

        foreach ($indicadores as $indicador)
        {
            $objeto = new \stdClass();

            $objeto->id          = $indicador->id;
            $objeto->nombre      = $indicador->nombre;
            $objeto->ponderacion = $indicador->ponderacion;


            $objeto =  $this->obtenerIndicadoresDeMeses($objeto, $evaluador_id);
            $cumplimiento = $cumplimiento + $objeto->promedio;
            $contador++;

            array_push($lista, $objeto);
        }

        array_push($lista, $this->obtenerDescripcion());
        array_push($lista, ($cumplimiento/$contador));

        return $lista;
    }

    /**
     * Obtener los datos totales de la grafica
     *
     * @param $indicadores
     * @param $evaluador_id
     */
    public function obtenerChartMes($indicadores, $evaluador_id)
    {
        $lista = array();
        $datos = array();
        $objeto = new \stdClass();

        foreach ($indicadores as $indicador)
        {
            array_push( $datos, $this->obtenerArrayColumns($indicador, $evaluador_id) );
        }
        $objeto->columns = $datos;
        $objeto->type = 'bar';
        array_push($lista, $objeto);
        array_push($lista, $this->obtenerCategoria());

        return $lista;
    }


    private function obtenerArrayColumns($indicador, $evaluador_id)
    {
        $lista = array();

        // colocamos el nombre del indicador
        array_push($lista, $indicador->nombre);

        // recorremos los meses desde el primer mes del diltro hasta el ultimo
        for ($inicio = \FiltroTabla::getPrimerMes(); $inicio <= \FiltroTabla::getUltimoMes(); $inicio++)
        {
            $datos = $this->obtenerDatosMes($indicador->id, $evaluador_id);
            // agregamos el datos para un mes

            array_push($lista, $datos[0]->promedio);
        }

        return $lista;
    }

    private function obtenerDescripcion()
    {
        $lista = array();

        for ($inicio = \FiltroTabla::getPrimerMes(); $inicio <= \FiltroTabla::getUltimoMes(); $inicio++)
        {
            $mes = new \stdClass();

            $mes->abr = $this->obtenerMesAbr($inicio);
            $mes->desc = \Calcana::getNombreMes($inicio);

            array_push($lista, $mes);

        }

        return $lista;
    }

    private function obtenerCategoria()
    {
        $lista = array();

        for ($inicio = \FiltroTabla::getPrimerMes(); $inicio <= \FiltroTabla::getUltimoMes(); $inicio++)
        {
            array_push($lista, \Calcana::getNombreMes($inicio));
        }

        return $lista;
    }
    
    /**
     * Obtener indicador por Meses indicador
    */
    private function obtenerIndicadoresDeMeses($objeto, $evaluador_id)
    {
        $lista = array();
        $promedio = 0;

        for ($inicio = \FiltroTabla::getPrimerMes(); $inicio <= \FiltroTabla::getUltimoMes(); $inicio++)
        {
            $datos = $this->obtenerDatosMes($objeto->id, $evaluador_id);


            array_push($lista, $this->crearObjetoMes($datos[0]->promedio, $inicio));

            $promedio = $promedio + $datos[0]->promedio;
        }

        $objeto->promedio = $promedio;
        $objeto->datos = $lista;

        return $objeto;
    }

    /**
     * Obtener el obtener dentro de la tabla
     *
     * @param $dato
     * @param $nro
     * @return \stdClass
     */
    private function crearObjetoMes($dato, $nro)
    {
        $mes = new \stdClass();
        
        $mes->id = $nro;
        $mes->abr = $this->obtenerMesAbr($nro);
        $mes->desc = \Calcana::getNombreMes($nro);
        $mes->valor = $dato;

        return $mes;
    }

    /**
     * Obtener las abriatura para la descripciones los meses
     *
     * @param $nro
     * @return string
     */
    private function obtenerMesAbr($nro)
    {
        $mes = str_split(\Calcana::getNombreMes($nro));

        $abr =  array_slice($mes, 0, 3);

        return $abr[0].$abr[1].$abr[2];
    }


    /**
     * Obtener datos de los indicadores para el mes del filtro cacheado
     *
     * @param $indicador
     * @param $evaluador_id
     * @return mixed
     */
    private function obtenerDatosMes($indicador_id, $evaluador_id)
    {
        // obtenemos las indicadores de un por semana
        return EvaluadoresRepository::cnGetIndicadoresSemana(
            $indicador_id,
            $evaluador_id,
            \FiltroTabla::getAnio(),
            \FiltroTabla::getPrimerMes()
        );
    }
}