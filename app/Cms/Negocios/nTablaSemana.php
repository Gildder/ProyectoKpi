<?php

namespace ProyectoKpi\Cms\Negocios;
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 21/05/2017
 * Time: 9:12
 */

use ProyectoKpi\Cms\Clases\TablaSemana;
use ProyectoKpi\Cms\Clases\Tabla;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Models\Evaluadores\Widget;

class nTablaSemana  extends Tabla
{
    private $semanas;
    public $widget;
    public function __construct(Widget $widget)
    {
        $this->semanas = 0;
        $this->widget = Widget::findOrFail($widget->id);
    }

    /**
     * retorna los datos de la tabla Widget por Tipo de Widget
     *
     */
    public function obtenerDatosTabla ()
    {

        $datos= null;
        switch ($this->widget->tipo_id){
            case 1: // por Tipo Indicadores
                $datos = $this->datosTipoIndicadorTabla();
                break;
            case 2: // por Empleados
                $datos = $this->datosEmpleadoTabla();

                break;
            case 3: // por Tareas
                $datos = $this->datosTareasTabla();
                break;
        }
        return $datos;
    }

    /**
     * retorna los datos de la tabla Widget por Tipo de Widget
     *
     */
    public function obtenerDatosChart ()
    {
        switch ($this->widget->tipo_id){
            case 1: // por Tipo Indicadores
                return $this->datosTipoIndicadorChart();
                break;
            case 2: // por Empleados
                return $this->datosEmpleadoChart();
                break;
            case 3: // por Tareas
                return $this->datosTareaChart();
                break;
            default:
        }
    }

    //************************************************

    public function datosTareasTabla()
    {
        // obtenemos la lista de empleados para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);

        $lista = array();

        $cumplimiento = 0;
        $contador = 0;

        foreach ($usuarios as $usuario)
        {
            $objeto = new \stdClass();

            $objeto->id = $usuario->id;
            $objeto->nombre = $usuario->nombres.' '. $usuario->apellidos;



            $objeto = $this->cargarFilaTablaTareas($objeto);
            array_push($lista, $objeto);

        }
        return $lista;
    }


    /**
     * Obtener Lista de indicadores de un mes por semanas
     */
    public function datosTipoIndicadorTabla()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $indicadores = IndicadorRepository::getIndicadoresDeEvaluador($this->widget->evaluador_id);

        $lista = array();

        $cumplimiento = 0;
        $contador = 0;
        if(sizeof($indicadores)>0) {

            foreach ($indicadores as $indicador) {
                $objeto = new \stdClass();

                $objeto->id = $indicador->id;
                $objeto->nombre = $indicador->nombre;
                $objeto->ponderacion = $indicador->ponderacion;

                $objeto = $this->obtenerIndicadorDeMes($objeto, $indicador->id);

                $cumplimiento = $cumplimiento + $objeto->promedio;
                $contador++;

                array_push($lista, $objeto);
            }
            array_push($lista, $this->descripcionPorSemanas());
            array_push($lista, ($cumplimiento / $contador));
        }
        return $lista;
    }

    /**
     * Obtener Lista de indicadores de un mes por semanas
     */
    public function datosEmpleadoTabla()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);

        $lista = array();

        $cumplimiento = 0;
        $contador = 0;
        if(sizeof($usuarios)>0) {
            foreach ($usuarios as $usuario) {
                $objeto = new \stdClass();

                $objeto->id = $usuario->id;
                $objeto->nombre = $usuario->nombres . ' ' . $usuario->apellidos;

                $objeto = $this->obtenerEmpleadoDeMes($objeto, $usuario->id);

                $cumplimiento = $cumplimiento + $objeto->promedio;
                $contador++;

                array_push($lista, $objeto);
            }
            array_push($lista, $this->descripcionPorSemanas());
            array_push($lista, ($cumplimiento / $contador));
        }
        return $lista;
    }

    /**
     * Obtener los datos totales de la grafica
     *
     * @param $indicadores
     * @param $evaluador_id
     */
    public function datosTipoIndicadorChart()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $indicadores = IndicadorRepository::getIndicadoresDeEvaluador($this->widget->evaluador_id);

        $lista = array();
        $datos = array();

        foreach ($indicadores as $indicador) {
            array_push($datos, $this->obtenerArrayColumns($indicador, $this->widget->evaluador_id));
        }

        array_push($lista, $datos);
        array_push($lista, $this->categoriasPorSemana());

        return $lista;
    }


    /**
     * Obtener los datos totales de la grafica
     *
     */
    public function datosEmpleadoChart()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);

        $lista = array();
        $datos = array();

        foreach ($usuarios as $usuario)
        {
            array_push( $datos, $this->obtenerArrayColumnsEmpleado($usuario) );
        }
        array_push($lista, $datos);
        array_push($lista, $this->categoriasPorSemana());

        return $lista;
    }

    /**
     * Obtener los datos totales de la grafica
     *
     */
    public function datosTareaChart()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);

        $lista = array();
        $resultado = array();
        $tareas = array();
        $tickets = array();
        $totales = array();

        foreach ($usuarios as $usuario)
        {
            // obtenemos los datos de la tabla
            // los sigueintes datos: semana, fecha Inicio y fin , actipro, actrea, efeser, ticketabiertos, ticketcerrados, eferser, efetotal, istecnico
            $datos = $this->ValoresIndicadoresPorTarea($usuario->id);

            if(sizeof($datos)>0){
                array_push($tareas, $datos[0]->eficacia_tarea);
                array_push($tickets, $datos[0]->eficacia_ticket);
                array_push($totales, $datos[0]->eficacia_total);
            }else{
                array_push($tareas, 0);
                array_push($tickets, 0);
                array_push($totales, 0);
            }
        }

        $datos = array();
        array_push($datos, 'Eficacia Tareas');
        foreach ($tareas as $tarea)
        {
            array_push($datos, $tarea);
        }

        array_push($lista, $datos);

        $datos = array();
        array_push($datos, 'Eficacia Tickets');
        foreach ($tickets as $ticket)
        {
            array_push($datos, $ticket);
        }

        array_push($lista, $datos);

        $datos = array();
        array_push($datos, 'Eficacia Total');
        foreach ($totales as $total)
        {
            array_push($datos, $total);
        }

        array_push($lista, $datos);

        // agregarmos al resultado
        array_push($resultado, $lista);
        array_push($resultado, $this->categoriasPorEmpleado());

        return $resultado;
    }

    private function obtenerArrayColumns($indicador)
    {
        $lista = array();

        array_push($lista, $indicador->nombre);

        $datos = $this->ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador->id);


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

    private function obtenerArrayColumnsEmpleado($usuario)
    {
        $lista = array();

        array_push($lista, $usuario->nombres.' '.$usuario->apellidos);

        $datos = $this->ValoresIndicadoresPorSemanaPorEmpleados($usuario->id);


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

    private function obtenerArrayColumnsTarea($usuario)
    {
        $lista = array();
        $datos = array();


        array_push($datos, 'Eficacia Tareas');
        array_push($datos, $datos[0]->eficacia_tarea);

        // obtenemos los datos de la tabla
        // los sigueintes datos: semana, fecha Inicio y fin , actipro, actrea, efeser, ticketabiertos, ticketcerrados, eferser, efetotal, istecnico
        $datos = $this->ValoresIndicadoresPorTarea($usuario->id);

        if(sizeof($datos)>0){
            array_push($lista, $datos[0]->eficacia_tarea);
            array_push($lista, $datos[0]->eficacia_ticket);
            array_push($lista, $datos[0]->eficacia_total);
        }else{
            // 3 por los campos vacios buscados arriba
            for ($index=1; $index<=3 ; $index++ ){
                array_push($lista, 0);
            }
        }

        return $lista;
    }


    /**
     * Obtener los indicadores de un mes por semana
    */
    public function obtenerIndicadorDeMes($objeto, $indicador_id)
    {

        $datos = $this->ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador_id);

        $objeto->mes = \Calcana::getNombreMes($this->widget->mesBuscado);

        $objeto->semanas  = $datos[0]->cantidadSemana;
        $objeto->promedio = $datos[0]->promedio;
        $objeto->datos = $this->obtenerSemanas($datos);

        //rescatamos los descripcion de las semanas
        $this->semanas = $datos[0]->cantidadSemana;

        return $objeto;
    }

    /**
     * Obtener los indicadores de un mes por semana
     */
    public function obtenerEmpleadoDeMes($objeto, $usuario_id)
    {

        $datos = $this->ValoresIndicadoresPorSemanaPorEmpleados($usuario_id);

        $objeto->mes = \Calcana::getNombreMes($this->widget->mesBuscado);

        $objeto->semanas  = $datos[0]->cantidadSemana;
        $objeto->promedio = $datos[0]->promedio;
        $objeto->datos = $this->obtenerSemanas($datos);

        //rescatamos los descripcion de las semanas
        $this->semanas = $datos[0]->cantidadSemana;

        return $objeto;
    }



    /**
     * Permite crear una obtejo semana
     *
     * @param $dato
     * @param $nro
     * @return \stdClass
     */
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
     *
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

    private function ValoresIndicadoresPorSemanaPorEmpleados($usuario_id)
    {
        return EvaluadoresRepository::cnGetIndicadoresEmpeladosSemana(
            $this->widget->indicador_id,
            $usuario_id,
            $this->widget->anio,
            $this->widget->mesBuscado
        );
    }

    private function ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador_id)
    {

        return EvaluadoresRepository::cnGetIndicadoresSemana(
            $this->widget->evaluador_id,
            $indicador_id,
            $this->widget->anio,
            $this->widget->mesBuscado
        );

    }

    private function ValoresIndicadoresPorTarea($usuario_id)
    {

        return EvaluadoresRepository::cnGetIndicadoresTareasSemana(
            $usuario_id,
            $this->widget->anio,
            $this->widget->mesTarea,
            $this->widget->semanaTarea
        );


    }

    /**
     * Obtenemos la descripcion de las semanas
     *
     * @return array
     */
    private function descripcionPorSemanas()
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


    /**
     * Obtenemos la descripcion de las semanas
     *
     * @return array
     */
    private function categoriasPorSemana()
    {
        $lista = array();
        for($i = 1; $i <= $this->semanas; $i++)
        {
            array_push($lista, 'Semana '.$i);
        }

        return $lista;
    }



    /**
     * Obtenemos la descripcion de las categorias por empleado
     *
     * @return array
     */
    private function categoriasPorEmpleado()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);


        $lista = array();
        foreach ($usuarios as $usuario)
        {
            array_push( $lista, $usuario->nombres.' '.$usuario->apellidos );
        }

        return $lista;
    }

    /**
     * @param $result
     * @param $objeto
     */
    private function cargarFilaTablaTareas($objeto)
    {
        $result = $this->ValoresIndicadoresPorTarea($objeto->id);
        if (sizeof($result) > 0) {

            $objeto->semana = $result[0]->semana;
            $objeto->fechaInicio = $result[0]->fechaInicio;
            $objeto->fechaFin = $result[0]->fechaFin;
            $objeto->actividad_programada = $result[0]->actividad_programada;
            $objeto->actividad_realizada = $result[0]->actividad_realizada;
            $objeto->eficacia_tarea = $result[0]->eficacia_tarea;
            $objeto->ticket_abierto = $result[0]->ticket_abierto;
            $objeto->ticket_cerrado = $result[0]->ticket_cerrado;
            $objeto->eficacia_ticket = $result[0]->eficacia_ticket;
            $objeto->eficacia_total = $result[0]->eficacia_total;
            $objeto->isTecnico = $result[0]->isTecnico;


        } else {
            $objeto->semana = 0;
            $objeto->fechaInicio = 0;
            $objeto->fechaFin = 0;
            $objeto->actividad_programada = 0;
            $objeto->actividad_realizada = 0;
            $objeto->eficacia_tarea = 0;
            $objeto->ticket_abierto = 0;
            $objeto->ticket_cerrado = 0;
            $objeto->eficacia_ticket = 0;
            $objeto->eficacia_total = 0;
            $objeto->isTecnico = 0;
        }

        return $objeto;
    }


}
