<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 04/05/2017
 * Time: 02:24 PM
 */

namespace ProyectoKpi\Cms\Interfaces;


interface IIndicador
{
    public function getTablas($empleado);
    public function getChart($empleado);
}