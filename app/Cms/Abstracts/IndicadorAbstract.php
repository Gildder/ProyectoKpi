<?php
namespace ProyectoKpi\Cms\Abstracts;

/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 07/05/2017
 * Time: 16:23
 */
abstract class IndicadorAbstract
{
    private $mesFinal;
    private $mesIncial;
    protected $semana1;
    protected $semana2;
    protected $semana3;
    protected $semana4;
    protected $semana5;

    public function __construct()
    {
        $this->inicializar();
    }

    /**
     * @param $semana numero de la semana
     * @param $posicion numero del mes
     * @valor $valor promedio de la semana
     *
    */
    public function setSemana($semana, $posicion, $valor)
    {
        if ($posicion != 0) {
            switch ($semana) {
                case 1:
                    $this->semana1[$posicion] = $valor;
                    break;
                case 2:
                    $this->semana2[$posicion] = $valor;
                    break;
                case 3:
                    $this->semana3[$posicion] = $valor;
                    break;
                case 4:
                    $this->semana4[$posicion] = $valor;
                    break;
                default:
                    $this->semana5[$posicion] = $valor;
                    break;
            }
        }
    }

    public function getSemana($semana, $posicion)
    {
        return $this->$semana[$posicion];
    }

    public function getMeses()
    {
        return [ $this->semana1, $this->semana2, $this->semana3, $this->semana4, $this->semana5 ];
    }

    public function inicializar()
    {
        $this->mesFinal = date('n', now());
        $this->semana1 = array($this->mesFinal);
        $this->semana2 = array($this->mesFinal);
        $this->semana3 = array($this->mesFinal);
        $this->semana4 = array($this->mesFinal);
        $this->semana5 = array($this->mesFinal);

        // iniciar los semanas
        array_push($this->semana1, 'Semana 1');
        array_push($this->semana2, 'Semana 2');
        array_push($this->semana3, 'Semana 3');
        array_push($this->semana4, 'Semana 4');
        array_push($this->semana5, 'Semana 5');
    }
}
