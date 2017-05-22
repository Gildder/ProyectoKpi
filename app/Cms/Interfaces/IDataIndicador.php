<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 04/05/2017
 * Time: 10:05 AM
 */

namespace ProyectoKpi\Cms\Interfaces;

interface IDataIndicador
{
    public function setValor($data, $valor);
    public function getValor($data);
}
