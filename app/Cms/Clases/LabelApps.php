<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 07/05/2017
 * Time: 15:02
 */

namespace ProyectoKpi\Cms\Clases;

class LabelApps
{
    //    *************************************************************************
    /* Label para la Grafica de Supervisores utilizando D3 */
    // Meses para el atributos Category de la GRafica D3JS de los Meses
    public static $lbsD3Enero = 'Enero';
    public static $lbsD3Febrero = 'Febrero';
    public static $lbsD3Marzo = 'Marzo';
    public static $lbsD3Abril = 'Abril';
    public static $lbsD3Mayo = 'Mayo';
    public static $lbsD3Junio = 'Junio';
    public static $lbsD3Julio = 'Julio';
    public static $lbsD3Agosto = 'Agosto';
    public static $lbsD3Septiembre = 'Septiembre';
    public static $lbsD3Octubre = 'Octubre';
    public static $lbsD3Noviembre = 'Noviembre';

    public static $lbsD3Diciembre = 'Diciembre';
    /**
     * Retorna un arreglo de las meses D3
    */
    public static function getArrayMesD3()
    {
        return array(
            self::$lbsD3Enero,
            self::$lbsD3Febrero,
            self::$lbsD3Marzo,
            self::$lbsD3Abril,
            self::$lbsD3Mayo,
            self::$lbsD3Junio,
            self::$lbsD3Julio,
            self::$lbsD3Agosto,
            self::$lbsD3Septiembre,
            self::$lbsD3Octubre,
            self::$lbsD3Noviembre,
            self::$lbsD3Diciembre
        );
    }
//    *************************************************************************
}
