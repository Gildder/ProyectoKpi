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

    public function toString()
    {
        return [
            'id'=> $this->id,
            'nombre'=> $this->nombre,
            'ponderacion'=>$this->ponderacion,
            'semana1'=>$this->semana1,
            'semana2'=>$this->semana2,
            'semana3'=>$this->semana3,
            'semana4'=>$this->semana4,
            'semana5'=>$this->semana5,
            'semana6'=>$this->semana6,
            'semanas'=>$this->semanas,
        ];
    }

    /**
     * Metodos
     */
    public function __construct()
    {
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

    /**
     * @param mixed $semana1
     */
    public function setSemana1($semana1)
    {
        $this->semana1 = $semana1;
    }

    /**
     * @param mixed $semana2
     */
    public function setSemana2($semana2)
    {
        $this->semana2 = $semana2;
    }

    /**
     * @param mixed $semana3
     */
    public function setSemana3($semana3)
    {
        $this->semana3 = $semana3;
    }

    /**
     * @param mixed $semana4
     */
    public function setSemana4($semana4)
    {
        $this->semana4 = $semana4;
    }

    /**
     * @param mixed $semana5
     */
    public function setSemana5($semana5)
    {
        $this->semana5 = $semana5;
    }

    /**
     * @param mixed $semana6
     */
    public function setSemana6($semana6)
    {
        $this->semana6 = $semana6;
    }

    /**
     * @param mixed $semanas
     */
    public function setSemanas($semanas)
    {
        $this->semanas = $semanas;
    }

}
