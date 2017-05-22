<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 2/05/17
 * Time: 20:59
 */

namespace ProyectoKpi\Cms\Clases;

use ProyectoKpi\Cms\Interfaces\IClases;
use ProyectoKpi\Cms\Interfaces\IDataIndicador;

/**
 * Clase para obtener el nombre dy valor de la semana
*/
class SemanaData implements IDataIndicador
{
    private $semana;
    private $valor;

    public function __construct($semana, $valor)
    {
        $this->setValor($semana, $valor);
    }


    public function setValor($data, $valor)
    {
        switch ($data) {
            case 1:
                $this->semana = 'Semana 1';
                $this->valor = $valor;
                break;
            case 2:
                $this->semana = 'Semana 2';
                $this->valor = $valor;
                break;
            case 3:
                $this->semana = 'Semana 3';
                $this->valor = $valor;
                break;
            case 4:
                $this->semana = 'Semana 4';
                $this->valor = $valor;
                break;
            case 5:
                $this->semana = 'Semana 5';
                $this->valor = $valor;
                break;
            default:
                $this->semana = 'Semana 6';
                $this->valor = $valor;
                break;
        }
    }


    public function getValor($atributo)
    {
        return $this->$atributo;
    }
}
