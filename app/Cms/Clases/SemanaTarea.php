<?php
namespace ProyectoKpi\Cms\Clases;

use ProyectoKpi\Cms\Interfaces\IClases;

/**
    * Clase SemanaTarea para gestionar los datos de las semana de trabajo de una tarea
    */
    class SemanaTarea implements IClases
    {
        private $anio;
        private $mes;
        private $semana;
        private $fechaInicio;
        private $fechaFin;
        private $siguiente;
        
        public function __construct()
        {
        }

        public function set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        public function get($atributo)
        {
            switch ($atributo) {
                case 'mes':
                    return $this->getNombreMes($this->$atributo);
                    break;
                case 'fechaInicio':
                    return $this->cambiarFormatoEuropeo($this->$atributo);
                    break;
                case 'fechaFin':
                    return $this->cambiarFormatoEuropeo($this->$atributo);
                    break;
                default:
                    return $this->$atributo;
                    break;
            }
        }

        public function getDateDB($atributo)
        {
            return $this->$atributo;
        }


        /*
         * Metodo para cambiar del formato Y-m-d  a d/m/Y
         *
         * @param string $fecha
         * @return fecha en formato d-m-Y
         */
        public function cambiarFormatoEuropeo($fecha)
        {
            if ($fecha == null) {
                return '00/00/0000';
            }
            $partes=explode('-', $fecha);//se parte la fecha
            $fecha=$partes[2].'/'.$partes[1].'/'.$partes[0];//se cambia para que quede formato d-m-Y
            return trim($fecha);
        }

        /*
         * Metodo para cambiar del formato Y/m/d  a d-m-Y
         *
         * @param string $fecha
         * @return fecha en formato d-m-Y
         */
        public function cambiarFormatoDB($fecha)
        {
            if ($fecha == null) {
                return '0000-00-00';
            }
            $partes=explode('/', $fecha);//se parte la fecha
            $fecha=$partes[2].'-'.$partes[1].'-'.$partes[0];//se cambia para que quede formato d-m-Y

            return trim($fecha);
        }

        public static function getNombreMes($num_mes)
        {
            switch ($num_mes) {
                case "1":
                    return 'Enero';
                    break;
                case "2":
                    return 'Febrero';
                    break;
                case "3":
                    return 'Marzo';
                    break;
                case "4":
                    return 'Abril';
                    break;
                case "5":
                    return 'Mayo';
                    break;
                case "6":
                    return 'Junio';
                    break;
                case "7":
                    return 'Julio';
                    break;
                case "8":
                    return 'Agosto';
                    break;
                case "9":
                    return 'Septiembre';
                    break;
                case "10":
                    return 'Octubre';
                    break;
                case "11":
                    return 'Noviembre';
                    break;
                default:
                    return 'Diciembre';
                    break;
            }
        }
    }
