<?php
use ProyectoKpi\Cms\Clases\TablaMes;

/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 18/05/2017
 * Time: 01:36 PM
 */
class TablaTest extends TestCase
{
    public function asignarTest()
    {
        $tabla = new TablaMes(1,'demo', 25, 1, 2017, 4);

    }

}