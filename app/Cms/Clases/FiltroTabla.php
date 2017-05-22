<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 11/05/2017
 * Time: 06:32 PM
 */

namespace ProyectoKpi\Cms\Clases;

class FiltroTabla
{
    // Semanal = 0 ; Mensual = 1;
    private $tipo;
    private $ultimoMes;
    private $primerMes; // para busquedas por mes
    private $mesBuscado; // para busquedas por semana
    private $anio;
    private $inicio = 1;
    private $fin = 12;

    public function __construct()
    {
        $this->tipo = 0;
        $this->ultimoMes = date('n') - 1;
        $this->primerMes = $this->ultimoMes;
        $this->mesBuscado = $this->ultimoMes;
        $this->anio = date('Y');
    }

    public function restarAlUltimoMes($cantidad)
    {
        return $this->ultimoMes - $cantidad;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getUltimoMes()
    {
        return $this->ultimoMes;
    }

    /**
     * @param mixed $ultimoMes
     */
    public function setUltimoMes($ultimoMes)
    {
        $this->ultimoMes = $ultimoMes;
    }

    /**
     * @return mixed
     */
    public function getPrimerMes()
    {
        return $this->primerMes;
    }

    /**
     * @param mixed $primerMes
     */
    public function setPrimerMes($primerMes)
    {
        $this->primerMes = $primerMes;
    }

    /**
     * @return mixed
     */
    public function getMesBuscado()
    {
        return $this->mesBuscado;
    }

    /**
     * @param mixed $mesBuscado
     */
    public function setMesBuscado($mesBuscado)
    {
        if ($mesBuscado <0 && $this->mesBuscado > 1) {
            $this->mesBuscado = $this->mesBuscado -1;
        } else {
            new \Exception('El mes No puede ser menor a 1');
        }

        if ($mesBuscado >= 0 && $this->mesBuscado < 11) {
            $this->mesBuscado = $this->mesBuscado + 1;
        } else {
            new \Exception('El mes No puede ser mayor a 12');
        }
        $this->mesBuscado = $mesBuscado;
    }

    /**
     * @return mixed
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * @param mixed $anio
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    }

    /**
     * @return int
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @return int
     */
    public function getInicio()
    {
        return $this->inicio;
    }
}
