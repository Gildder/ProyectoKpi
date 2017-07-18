<?php

namespace ProyectoKpi\Cms\Negocios;
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 21/05/2017
 * Time: 9:12
 */

use function print_r;
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
            array_push($lista, ($cumplimiento/$contador));
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

        if(sizeof($usuarios)>0) {

            foreach ($usuarios as $usuario) {
                // creamos el objeto a devolver a la vista
                $objeto = new \stdClass();

                // guardamos los datos de los indicadores recorridos

                $objeto->id = $usuario->id;
                $objeto->nombre = $usuario->nombres . ' ' . $usuario->apellidos;

                // obtenemos los datos de los indicadores
                $objeto = $this->obtenerempleadosDeMeses($objeto, $usuario->id);
                $cumplimiento = $cumplimiento + $objeto->promedio;
                $contador++;

                array_push($lista, $objeto);
            }

            array_push($lista, $this->obtenerDescripcion());
            array_push($lista, ($cumplimiento / $contador));
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

        // recorremos los meses desde el inicio hasta el mes actual -1
        for ($inicio = $this->widget->mesInicio; $inicio < $this->widget->ultimoMes(); $inicio++)
        {
            // obtenemos los datos promedio de los indciadores por tipo de widget
            $datos = $this->ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador_id);

            // agregamos a la lista el valor y el objeto mes
            array_push($lista, $this->crearObjetoMes($datos[0]->promedio, $inicio));

            // sumatoria de los promedios de los meses
            $promedio = $promedio + $datos[0]->promedio;
        }

        // agregamos el promedio total
        $objeto->promedio = $promedio;

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
        $promedio = 0;

        // recorremos los meses desde el inicio hasta el mes actual -1
        for ($inicio = $this->widget->mesInicio; $inicio < $this->widget->ultimoMes(); $inicio++)
        {
            // obtenemos los datos promedio de los indciadores por tipo de widget
            $datos = $this->ValoresIndicadoresPorSemanaPorEmpleados($usuario_id);

            // agregamos a la lista el valor y el objeto mes
            array_push($lista, $this->crearObjetoMes($datos[0]->promedio, $inicio));

            // sumatoria de los promedios de los meses
            $promedio = $promedio + $datos[0]->promedio;
        }

        // agregamos el promedio total
        $objeto->promedio = $promedio;

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

        // colocamos el nombre del indicador
        array_push($lista, $indicador->nombre);

        // recorremos los meses desde el primer mes del diltro hasta el ultimo
        for ($inicio = $this->widget->mesInicio; $inicio < $this->widget->ultimoMes(); $inicio++)
        {
            $datos = $this->ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador->id, $evaluador_id);
            // agregamos el datos para un mes

            array_push($lista, $datos[0]->promedio);
        }

        return $lista;
    }

    private function obtenerArrayColumnsEmpleado($usuario, $evaluador_id)
    {
        $lista = array();

        // colocamos el nombre del indicador
        array_push($lista, $usuario->nombres. ' '.$usuario->apellidos);

        // recorremos los meses desde el primer mes del diltro hasta el ultimo
        for ($inicio = $this->widget->mesInicio; $inicio < $this->widget->ultimoMes(); $inicio++)
        {
            $datos = $this->ValoresIndicadoresPorSemanaPorEmpleados($usuario->id, $evaluador_id);
            // agregamos el datos para un mes

            array_push($lista, $datos[0]->promedio);
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

        for ($inicio = $this->widget->mesInicio; $inicio < $this->widget->ultimoMes(); $inicio++)
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

    private function ValoresIndicadoresPorSemanaPorEmpleados($usuario_id)
    {
        return EvaluadoresRepository::cnGetIndicadoresEmpeladosSemana(
            $this->widget->indicador_id,
            $usuario_id,
            $this->widget->anio,
            $this->widget->mesInicio
        );
    }

    private function ValoresIndicadoresPorSemanaPorTipoIndicadores($indicador_id)
    {
        return EvaluadoresRepository::cnGetIndicadoresSemana(
            $this->widget->evaluador_id,
            $indicador_id,
            $this->widget->anio,
            $this->widget->mesInicio
        );
    }


}
