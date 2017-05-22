<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 21/05/2017
 * Time: 19:53
 */

namespace ProyectoKpi\Cms\Clases;


class Indicador
{
    private $id;
    private $nombre;
    private $ponderacion;

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
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPonderacion()
    {
        return $this->ponderacion;
    }

    /**
     * @param mixed $ponderacion
     */
    public function setPonderacion($ponderacion)
    {
        $this->ponderacion = $ponderacion;
    }


}