<?php

namespace ProyectoKpi\Cms\Negocios;
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 21/05/2017
 * Time: 9:12
 */

use ProyectoKpi\Cms\Clases\TablaMes;
use ProyectoKpi\Cms\Clases\Tabla;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Models\Evaluadores\Widget;

class nTablaMes extends Tabla
{
    protected $widget;
    public function __construct(Widget $widget)
    {
        $this->widget = $widget;
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
                $datos =  $this->datosTipoIndicadorTabla();
                break;
            case 2: // por Empleados
                $datos =  $this->datosEmpleadoTabla();

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
    public function obtenerDatosChart()
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


    /**
     * Obtenemos la datos mapeados para pasar a la vista
     *
     */
    public function datosTipoIndicadorTabla()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $indicadores = IndicadorRepository::getIndicadoresDeEvaluador($this->widget->evaluador_id);
        $lista = array();
        $cumplimiento = 0;
        $contador = 0;

        if(sizeof($indicadores) > 0){

            foreach ($indicadores as $indicador)
            {
                // creamos el objeto a devolver a la vista
                $objeto = new \stdClass();

                // guardamos los datos de los indicadores recorridos

                $objeto->id          = $indicador->id;
                $objeto->nombre      = $indicador->nombre;
                $objeto->ponderacion = $indicador->ponderacion;

                // obtenemos los datos de los indicadores
                $objeto =  $this->obtenerIndicadoresDeMeses($objeto,  $indicador->id);
                $cumplimiento = $cumplimiento + $objeto->promedio;
                $contador++;

                array_push($lista, $objeto);
            }

            array_push($lista, $this->obtenerDescripcion());
            array_push($lista, round(($cumplimiento/$contador),2));
        }

        return $lista;
    }


    /**
     * Obtenemos la datos mapeados para pasar a la vista
     *
     * @param $indicadores
     * @param $evaluador_id
     * @return array
     *
     */
    public function datosEmpleadoTabla()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);

        $lista = array();
        $cumplimiento = 0;
        $contador = 0;

        if(sizeof($usuarios)> 0) {
            foreach ($usuarios as $usuario) {

                // creamos el objeto a devolver a la vista
                $objeto = new \stdClass();

                // obtenemos los datos de los indicadores
                $objeto = $this->obtenerempleadosDeMeses($objeto, $usuario->id);
                if(isset($objeto)) {
                    // guardamos los datos de los indicadores recorridos
                    $objeto->id = $usuario->id;
                    $objeto->nombre = $usuario->nombres . ' ' . $usuario->apellidos;

                    $cumplimiento = $cumplimiento + $objeto->promedio;
                    $contador++;

                    array_push($lista, $objeto);
                }
            }

            array_push($lista, $this->obtenerDescripcion());
            if($cumplimiento > 0) {
                array_push($lista, round(($cumplimiento / $contador), 2));
            }else{
                array_push($lista, 0);

            }
        }
        return $lista;
    }



    /**
     * Obtener indicador por Meses para los tipo de widget por Tipo de Indicadores y Empleados
     */
    private function obtenerIndicadoresDeMeses($objeto , $indicador_id)
    {
        $lista = array();
        $promedio = 0;

        if($this->widget->mesInicio == 0)
        {
            $this->widget->mesInicio = 1;
        }

        $valores = array();
        $contadorMes = 0;
        $inicio = $this->widget->mesInicio;
        // recorremos los meses desde el inicio hasta el mes actual -1
        while ( $inicio < Widget::ultimoMes())
        {
            // obtenemos los datos promedio de los indciadores por tipo de widget
            $datos = $this->ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador_id, $inicio);

            $resPromedio = 0;
            if(isset($datos[0]->promedio) ) {
                $resPromedio = $datos[0]->promedio;
            }

            if($resPromedio <> 0){
                $contadorMes++;
            }


            // sumatoria de los promedios de los meses
                $promedio = $promedio + $resPromedio;


            // agregamos a la lista el valor y el objeto mes
            array_push($lista, $this->crearObjetoMes($resPromedio, $inicio));
            array_push($valores, $resPromedio );

            $inicio++;
        }

        // agregamos el promedio total
        if($promedio <> 0){
            $objeto->promedio =  round(($promedio/$contadorMes), 2);
        }else{
            $objeto->promedio =  $promedio;
        }


        // agregamos los lista de los valores del indicadores de los meses recorridos
        $objeto->datos = $lista;

        return $objeto;

    }

    /**
     * Obtener indicador por Meses para los tipo de widget por Tipo de Indicadores y Empleados
     */
    private function obtenerempleadosDeMeses($objeto , $usuario_id)
    {
        $lista = array();
        $contador = 0;
        $promedio = 0;

        // recorremos los meses desde el inicio hasta el mes actual -1
        for ($inicio = $this->widget->mesInicio; $inicio < Widget::ultimoMes(); $inicio++)
        {
            // obtenemos los datos promedio de los indciadores por tipo de widget
            $datos = $this->ValoresIndicadoresPorSemanaPorEmpleados($usuario_id, $inicio);

            $resPromedio = 0;
            if(isset($datos[0]->promedio) ) {
                $resPromedio = $datos[0]->promedio;
            }

            if($resPromedio <> 0){
                $contador++;
            }


            // agregamos a la lista el valor y el objeto mes
            array_push($lista, $this->crearObjetoMes($resPromedio, $inicio));

            // sumatoria de los promedios de los meses
            $promedio = $promedio + $resPromedio;
        }

        // agregamos el promedio total
        if($promedio > 0){
            $objeto->promedio = round(($promedio/$contador),2);
        }else{
            $objeto->promedio = 0;
        }


        // agregamos los lista de los valores del indicadores de los meses recorridos
        $objeto->datos = $lista;


        return $objeto;
    }


    /**
     * Obtener los datos totales de la Chart para los Widget
     *
     */
    public function datosTipoIndicadorChart()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $indicadores = IndicadorRepository::getIndicadoresDeEvaluador($this->widget->evaluador_id);

        $lista = array();
        $datos = array();

        foreach ($indicadores as $indicador)
        {
            array_push( $datos, $this->obtenerArrayColumns($indicador, $this->widget->evaluador_id) );
        }
        array_push($lista, $datos);
        array_push($lista, $this->obtenerCategoria());

        return $lista;
    }


    public function datosEmpleadoChart()
    {
        // obtenemos la lista de indicadores para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);

        $lista = array();
        $datos = array();

        foreach ($usuarios as $usuario)
        {
            array_push( $datos, $this->obtenerArrayColumnsEmpleado($usuario, $this->widget->evaluador_id) );
        }
        array_push($lista, $datos);
        array_push($lista, $this->obtenerCategoria());

        return $lista;
    }

    private function obtenerArrayColumns($indicador, $evaluador_id)
    {
        $lista = array();

        if($this->widget->mesInicio == 0)
        {
            $this->widget->mesInicio = 1;
        }

        // colocamos el nombre del indicador
        array_push($lista, $indicador->nombre);

        // recorremos los meses desde el primer mes del diltro hasta el ultimo
        for ($inicio = $this->widget->mesInicio; $inicio < Widget::ultimoMes(); $inicio++)
        {
            $datos = $this->ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador->id, $inicio);
            // agregamos el datos para un mes

            array_push($lista, $datos[0]->promedio);
        }

        return $lista;
    }

    private function obtenerArrayColumnsEmpleado($usuario, $evaluador_id)
    {
        $lista = array();
        $contador = 0;

        // colocamos el nombre del indicador
        array_push($lista, $usuario->nombres. ' '.$usuario->apellidos);

        // recorremos los meses desde el primer mes del diltro hasta el ultimo
        for ($inicio = $this->widget->mesInicio; $inicio < Widget::ultimoMes(); $inicio++)
        {
            $datos = $this->ValoresIndicadoresPorSemanaPorEmpleados($usuario->id, $inicio);
            // agregamos el datos para un mes
            if( $datos[0]->habilitado <> -1) {

                array_push($lista, $datos[0]->promedio);
            }else{
                array_push($lista, 0);

            }
        }

        return $lista;
    }

    private function obtenerDescripcion()
    {
        $lista = array();

        for ($inicio = $this->widget->mesInicio; $inicio < $this->widget->ultimoMes(); $inicio++)
        {
            $mes = new \stdClass();

            $mes->abr = \Calcana::abreviaturaMes($inicio);
            $mes->desc = \Calcana::getNombreMes($inicio);

            array_push($lista, $mes);

        }

        return $lista;
    }

    private function obtenerCategoria()
    {
        $lista = array();

        for ($inicio = $this->widget->mesInicio; $inicio < Widget::ultimoMes(); $inicio++)
        {
            array_push($lista, \Calcana::getNombreMes($inicio));
        }

        return $lista;
    }
    


    /**
     * Devuelve un objeto Mes con el valor de del indicadores
     *
     * @param $dato
     * @param $nro
     * @return \stdClass
     */
    private function crearObjetoMes($dato, $nro)
    {
        // creamos el obtejto generico
        $mes = new \stdClass();

        // agregamamso los campos necesarios del objeto
        $mes->id = $nro;
        $mes->abr = \Calcana::abreviaturaMes($nro);
        $mes->desc = \Calcana::getNombreMes($nro);
        $mes->valor = $dato;

        return $mes;
    }

    /**
     * Obtener datos de la base de datos del indicadores por tipo de widget
     *
     */
    private function ValoresIndicadoresPorSemanaPorTarea($indicador_id, $evaluador_id)
    {
        return EvaluadoresRepository::cnGetIndicadoresTareasSemana(
            $this->widget->user_id,
            $this->widget->anio,
            $this->widget->mesTarea,
            $this->widget->semanaTarea
        );
    }

    private function ValoresIndicadoresPorSemanaPorEmpleados($usuario_id, $mes)
    {
        return EvaluadoresRepository::cnGetIndicadoresEmpeladosSemana(
            $this->widget->indicador_id,
            $usuario_id,
            $this->widget->anio,
            $mes
        );
    }

    private function ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador_id, $mes)
    {
        return EvaluadoresRepository::cnGetIndicadoresSemana(
            $this->widget->evaluador_id,
            $indicador_id,
            $this->widget->anio,
            $mes
        );
    }

    private function datosTareasTabla()
    {
        // obtenemos la lista de empleados para la gerencia evaluadora deñ widget
        $usuarios = EvaluadoresRepository::cnGetEmpleadosEvaluados($this->widget->indicador_id, $this->widget->evaluador_id);

        $lista = array();

        $cumplimiento = 0;
        $contador = 0;

        // recorremos todos los empelados ligados
        foreach ($usuarios as $usuario)
        {
            $objeto = new \stdClass();

            $objeto->id = $usuario->id;
            $objeto->nombre = $usuario->nombres.' '. $usuario->apellidos;


            // pasamos los datos del empleados buscado para encontrar sus indicadores
            $objeto = $this->cargarFilaTablaTareas($objeto);
            array_push($lista, $objeto);

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


        if(!isset($result)){
            $objeto->semana = 0;
            $objeto->fechaInicio = 0;
            $objeto->fechaFin = 0;
            $objeto->actividad_programada = 0;
            $objeto->actividad_realizada = 0;
            $objeto->eficacia_tarea = 0;
            $objeto->ticket_abierto = 0;
            $objeto->ticket_cerrado = 0;
            $objeto->eficacia_ticket = 0;
            $objeto->eficacia_total = 10;
            $objeto->isTecnico = \GuzzleHttp\json_encode($result);
        }else
        {
                $cantidad = 0;
                $contador = 1;
                $programados = 0;
                $realizados = 0;
                $efeTareas = 0;
                $abiertos = 0;
                $cerrados = 0;
                $efeTickets = 0;
                $efeTotal = 0;
                foreach($result as  $indicador){


                    if($contador === 1)
                    {
                        $objeto->semana = $this->widget->semanaTarea;
                        $objeto->fechaInicio = $indicador->fechaInicio;
                        $objeto->isTecnico = $indicador->isTecnico;
                    }

                    if($contador = sizeof($result))
                    {
                        $objeto->fechaFin = $indicador->fechaFin;
                    }

                    $programados = $programados + $indicador->actividad_programada;
                    $realizados = $realizados + $indicador->actividad_realizada;
                    $efeTareas = $efeTareas + $indicador->eficacia_tarea;
                    $abiertos = $abiertos + $indicador->ticket_abierto;
                    $cerrados = $cerrados + $indicador->ticket_cerrado;
                    $efeTickets = $efeTickets + $indicador->eficacia_ticket;
                    $efeTotal = $efeTotal + $indicador->eficacia_total;
                    $cantidad = $indicador->cantidadSemana;

                    $contador++;
                }
                $objeto->actividad_programada = $programados;
                $objeto->actividad_realizada = $realizados;
                if($efeTareas <> 0){
                    $objeto->eficacia_tarea = round(($efeTareas / $cantidad ), 2);
                }else{
                    $objeto->eficacia_tarea = $efeTareas;
                }
                $objeto->ticket_abierto = $abiertos;
                $objeto->ticket_cerrado = $cerrados;

                if($efeTareas <> 0){
                    $objeto->eficacia_ticket = round(($efeTickets /$cantidad ),2);
                }else{
                    $objeto->eficacia_ticket = $efeTickets;
                }


                if($efeTareas <> 0){
                    $objeto->eficacia_total = round(($efeTotal /$cantidad ), 2);
                }else{
                    $objeto->eficacia_total = $efeTotal;
                }
        }

        return $objeto;
    }

    private function ValoresIndicadoresPorTarea($usuario_id)
    {

        if($this->widget->isSemanal === 0)
        {
            return EvaluadoresRepository::cnGetIndicadoresTareasSemana(
                $usuario_id,
                $this->widget->anio,
                $this->widget->mesTarea,
                $this->widget->semanaTarea
            );
        }else{
            return EvaluadoresRepository::cnGetIndicadoresTareasSemana(
                $usuario_id,
                $this->widget->anio,
                $this->widget->mesTarea,
                0
            );


        }


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
            $objeto = new \stdClass();
            $objeto->id = $usuario->id;
            $datos = $this->cargarFilaTablaTareas($objeto);

            array_push($tareas, $datos->eficacia_tarea);
            array_push($tickets, $datos->eficacia_ticket);
            array_push($totales, $datos->eficacia_total);

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


}
