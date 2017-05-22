<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 10/05/2017
 * Time: 01:15 PM
 */

namespace ProyectoKpi\Cms\Abstracts;

use Illuminate\Support\Facades\DB;

/**
 * Tabla de Indicadores de TablaMes
*/
abstract class TablaAbstract
{
    protected $id;
    protected $nombre;
    protected $ponderacion;
    protected $promedio;


    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getPromedio()
    {
        return $this->promedio;
    }


    /**
     * @return mixed
     */
    public function getPonderacion()
    {
        return $this->ponderacion;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $ponderacion
     */
    public function setPonderacion($ponderacion)
    {
        $this->ponderacion = $ponderacion;
    }

    /**
     * @param mixed $promedio
     */
    public function setPromedio($promedio)
    {
        $this->promedio = $promedio;
    }
}
