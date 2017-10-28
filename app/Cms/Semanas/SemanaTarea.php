<?php
namespace ProyectoKpi\Cms\Semanas;

use Illuminate\Support\Facades\DB;

/**
* Clase SemanaTarea para gestionar los datos de las semana de trabajo de una tarea
*/
class SemanaTarea
{
    protected $fecha;
    protected $semana;

    public function __construct()
    {
        $this->fecha = date('Y-m-d');
        $this->semana = $this->buscarSemana(date('Y-m-d'));
    }

    /**
     * Retorn las datos de la semana actual de las tareas
     *
     * @param $fecha formato Y-m-d
     * @return mixed
     */
    public function buscarSemana($fecha)
    {
        if(\Calcana::validarFormatoEuropeo($fecha)){
            $fecha = \Calcana::cambiarFormatoDB($fecha);
        }

        $semana =  DB::select("call pa_obtenerFechaSemanaAnual('".$fecha."');");

        $this->fecha = $fecha;
        $this->semana = $semana[0];

        // el nuevo objeto
        return $semana[0];
    }

    /**
     * Retorna la semana de tarea en foramto de DB
     *
     * @param $fecha formato Y-m-d
     * @return mixed
     */
    public function buscarSemanaDB($fecha)
    {
        if(\Calcana::validarFormatoEuropeo($fecha)){
            $fecha = \Calcana::cambiarFormatoDB($fecha);
        }

        $semana =  DB::select("call pa_obtenerFechaSemanaAnualDB('".$fecha."');");

        $this->fecha = $fecha;
        $this->semana = $semana[0];

        return $semana[0];
    }

    public function getSemanaSigte()
    {
        $this->fecha = date(date('Y-m-d', strtotime('now +7 day')));

        $this->semana =  DB::select("call pa_obtenerFechaSemanaAnual('".$this->fecha."');")[0];

        return $this;
    }


    /**
     * Metodos getter y setter
     *
     */
    public function getSemana()
    {
        return $this->semana;
    }



}
