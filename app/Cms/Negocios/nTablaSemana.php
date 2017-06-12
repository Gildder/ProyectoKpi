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
    private $semanas;

    public function __construct()
    {
        $this->semanas = 0;
    }

    /**
     * Obtener Lista de indicadores de un mes por semanas
     */
    public function obtenerListaIndicadoresDeMes($indicadores, $evaluador_id)
    {
        $lista = array();

        $cumplimiento = 0;
        $contador = 0;

        foreach ($indicadores as $indicador)
        {
            $objeto = new \stdClass();

            $objeto->id          = $indicador->id;
            $objeto->nombre      = $indicador->nombre;
            $objeto->ponderacion = $indicador->ponderacion;

            $objeto =  $this->obtenerIndicadorDeMes($objeto, $evaluador_id) ;

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

        array_push($lista, $indicador->nombre);

        $datos = $this->obtenerDatosMes($indicador->id, $evaluador_id);

        array_push($lista, $datos[0]->semana_1);
        array_push($lista, $datos[0]->semana_2);
        array_push($lista, $datos[0]->semana_3);
        array_push($lista, $datos[0]->semana_4);
        switch ($datos[0]->cantidadSemana) {
            case 5:
                array_push($lista, $datos[0]->semana_5);
                break;
            case 6:
                array_push($lista, $datos[0]->semana_5);
                array_push($lista, $datos[0]->semana_6);
                break;
        }

        $this->semanas = $datos[0]->cantidadSemana;



        return $lista;
    }


    /**
     * Obtener los indicadores de un mes por semana
    */
    public function obtenerIndicadorDeMes($objeto, $evaluador_id)
    {

        $datos = $this->obtenerDatosMes($objeto->id, $evaluador_id);

        $objeto->mes = \Calcana::getNombreMes(\FiltroTabla::getMesBuscado());

        $objeto->semanas  = $datos[0]->cantidadSemana;
        $objeto->promedio = $datos[0]->promedio;
        $objeto->datos = $this->obtenerSemanas($datos);

        //rescatamos los descripcion de las semanas
        $this->semanas = $datos[0]->cantidadSemana;

        return $objeto;
    }

    private function crearObjetoSemana($dato, $nro)
    {
        $semana = new \stdClass();

        $semana->id = $nro;
        $semana->abr = 'Sem '.$nro;
        $semana->desc = 'Semana '.$nro;
        $semana->valor = $dato;

        return $semana;
    }



    /**
     * @param $datos
     * @return array
     */
    private function obtenerSemanas($datos)
    {
        $lista = array();

        $this->semanas = $datos[0]->cantidadSemana;

        array_push($lista, $this->crearObjetoSemana($datos[0]->semana_1, 1));
        array_push($lista, $this->crearObjetoSemana($datos[0]->semana_2, 2));
        array_push($lista, $this->crearObjetoSemana($datos[0]->semana_3, 3));
        array_push($lista, $this->crearObjetoSemana($datos[0]->semana_4, 4));
        switch ($datos[0]->cantidadSemana) {
            case 5:
                array_push($lista, $this->crearObjetoSemana($datos[0]->semana_5, 5));
                break;
            case 6:
                array_push($lista, $this->crearObjetoSemana($datos[0]->semana_5, 5));
                array_push($lista, $this->crearObjetoSemana($datos[0]->semana_6, 6));
                break;
        }

        return $lista;
    }

    /**
     * @param $objeto
     * @param $evaluador_id
     * @return mixed
     */
    private function obtenerDatosMes($indicador_id, $evaluador_id)
    {
        return EvaluadoresRepository::cnGetIndicadoresSemana(
            $indicador_id,
            $evaluador_id,
            \FiltroTabla::getAnio(),
            \FiltroTabla::getMesBuscado()
        );
    }


    private function obtenerDescripcion()
    {
        $lista = array();
        for($i = 1; $i <= $this->semanas; $i++)
        {
            $semana = new \stdClass();
            $semana->abr = 'Sem '.$i;
            $semana->desc = 'Semana '.$i;

            array_push($lista, $semana);
        }

        return $lista;
    }

    private function obtenerCategoria()
    {
        $lista = array();
        for($i = 1; $i <= $this->semanas; $i++)
        {
            array_push($lista, 'Semana '.$i);
        }

        return $lista;
    }


}
