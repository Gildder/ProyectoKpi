<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 10/05/2017
 * Time: 01:17 PM
 */

namespace ProyectoKpi\Cms\Clases;


use ProyectoKpi\Cms\Abstracts\TablaAbstract;

class TablaSemana extends TablaAbstract
{
	/* Atributos */
    private $semana1;
    private $semana2;
    private $semana3;
    private $semana4;
    private $semana5;
    private $semana6;
    private $semanas;

    /**
    */
    public function __construct($id, $nombre, $ponderacion, $evaluador)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ponderacion = $ponderacion;

        $this->getDatosDeTablaIndicadores($id, $evaluador);
    }

    /**
     * Retorna el promedio de un Indicador
     */
    public function getDatosDeTablaIndicadores($indicador_id, $evaluador_id)
    {
        $anio =  \FiltroTabla::getAnio();
        $mes  =  \FiltroTabla::getMesBuscado();

        $datos = $this->cnGetIndicadoresSemana($indicador_id, $evaluador_id, $anio, $mes);

        $this->asignarPromedio($datos);
    }

    /**
     * Asignamos el Promedio de los indicadores a cada semana y obtenemos el promedio del mes
     *
     */
    private function asignarPromedio($datos)
    {
        $this->semana1 = $datos[0]->semana_1;
        $this->semana2 = $datos[0]->semana_2;
        $this->semana3 = $datos[0]->semana_3;
        $this->semana4 = $datos[0]->semana_4;
        switch ($datos[0]->cantidadSemana) {
            case 5:
                $this->semana5 = $datos[0]->semana_5;
                break;
            case 6:
                $this->semana5 = $datos[0]->semana_5;
                $this->semana6 = $datos[0]->semana_6;
                break;
        }
//        contador de tiempo sera igual a mi cantidad de semanas del mes
        $this->promedio = $datos[0]->promedio;
        $this->semanas = $datos[0]->cantidadSemana;
    }

    /**
     * @return mixed
     */
    public function getSemana1()
    {
        return $this->semana1;
    }

    /**
     * @return mixed
     */
    public function getSemana2()
    {
        return $this->semana2;
    }

    /**
     * @return mixed
     */
    public function getSemana3()
    {
        return $this->semana3;
    }

    /**
     * @return mixed
     */
    public function getSemana4()
    {
        return $this->semana4;
    }

    /**
     * @return mixed
     */
    public function getSemana5()
    {
        return $this->semana5;
    }

    /**
     * @return mixed
     */
    public function getSemana6()
    {
        return $this->semana6;
    }

    /**
     * @return mixed
     */
    public function getSemanas()
    {
        return $this->semanas;
    }


}