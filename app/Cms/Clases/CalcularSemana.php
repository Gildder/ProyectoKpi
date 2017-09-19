<?php

namespace ProyectoKpi\Cms\Clases;

use \Illuminate\Support\Facades\Facade;

use ProyectoKpi\Cms\Clases\SemanaTarea;
use ProyectoKpi\Cms\Interfaces\IClases;

class CalcularSemana
{

    /*contructores */
    public function __construct()
    {
    }
    // /* Metodos */

    /**
     * retorna un arreglos de fecha de inicio y fin de la semana
     */
    public function inicioFinSemana($fecha)
    {
        $strFecha = strtotime($fecha);

        // Asignamos los dias de inicio y fin de la semana
        $diaInicio = "Monday";
        $diaFin = "Sunday";

        $fechaInicio = date('Y-m-d', strtotime('last ' . $diaInicio, $strFecha));
        $fechaFin = date('Y-m-d', strtotime('next ' . $diaFin, $strFecha));

        if (date("l", $strFecha) == $diaInicio) {
            $fechaInicio = date("Y-m-d", $strFecha);
        }
        if (date("l", $strFecha) == $diaFin) {
            $fechaFin = date("Y-m-d", $strFecha);
        }
        return array("fechaInicio" => $fechaInicio, "fechaFin" => $fechaFin);
    }


    /**
     * obtener el numero de dias de un mes
     */
    public function numeroDiasMes($fecha)
    {
        $Month = date('n', strtotime($fecha));
        $Year = date('Y', strtotime($fecha));
        //Si la extensión que mencioné está instalada, usamos esa.
        if (is_callable("cal_days_in_month")) {
            return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
        } else {
            //Lo hacemos a mi manera.
            return date("d", mktime(0, 0, 0, $Month + 1, 0, $Year));
        }
    }


    /**
     * Retorna la semana de Tarea una fecha
     * @param fecha : fecha de interes
     */
    public function getSemanaTarea($fecha)
    {
        // Obtenemos las fecha de inicio y fin de semana
        $fechas = $this->inicioFinSemana($fecha);

        // obtenemos el nuemro de dias de un mes
        $diasMes = $this->numeroDiasMes($fechas['fechaInicio']);

        // obtenemos el numero del dia mes 1 a 31
        $diaActual = date("j", strtotime($fechas['fechaInicio']));

        // Obtenemos los dias restantes a fin de mes
        $diasRestantes = $diasMes - $diaActual;

        //Instancia de la Semana de Tarea
        $semanaTarea = new SemanaTarea();
        $semanaTarea->set('anio', date("Y", strtotime($fechas['fechaInicio'])));
        $semanaTarea->set('mes', date("n", strtotime($fechas['fechaInicio'])));
        $semanaTarea->set('semana', $this->numeroSemanaFecha($fechas['fechaInicio']));
        $semanaTarea->set('fechaInicio', $fechas['fechaInicio']);
        $semanaTarea->set('fechaFin', $fechas['fechaFin']);

        // Si los dias del mes restante el menor
        if ($diasRestantes < 4) {
            // entonces se tomarà el mes siguiente con su semana
            $semanaTarea->set('mes', date("n", strtotime($fechas['fechaFin'])));
            $semanaTarea->set('semana', $this->numeroSemanaFecha($fechas['fechaFin']));
        }

        return $semanaTarea;
    }

    /* retorna la semana de una fecha */
    public function numeroSemanaFecha($fecha)
    {
        // Calculamos la semana del mes
        $semanaInicioMes = date("W", strtotime(date("Y-m-01", strtotime($fecha))));
        $semanaActualFecha = date("W", strtotime($fecha));

        $result = $semanaActualFecha - $semanaInicioMes;

        if ($result == 0) {
            if (date('j', strtotime($fecha)) > 4) {
                return $result + 1;
            }
        }

        return $result;
    }

    /**
     * Sumar dias a una fecha particular
     * @param $fecha : tipo date
     * @param $dias : tipo integer
     * @return date
     */
    public function sumarDias($fecha, $dias)
    {
        $nuevafecha = strtotime('+' . $dias . ' day', strtotime($fecha));
        $nuevafecha = date('Y-m-d', $nuevafecha);
        return $nuevafecha;
    }

    public function restarDias($fecha, $dias)
    {
        $nuevafecha = strtotime('-' . $dias . ' day', strtotime($fecha));
        $nuevafecha = date('Y-m-d', $nuevafecha);
        return $nuevafecha;
    }

    /**
     * Retorna la semanas habilitadas
     * @param fecha : fecha de interes
     */
    public function getSemanasProgramadas($fecha)
    {
        // Semana de Tarea de la fecha Solicitada
        $semanaTarea = $this->getSemanaTarea($fecha);

        // date("N") Día de la semana, desde 1 (lunes) hasta 7 (domingo)
        //Si es Viernes = 5 entonces tomamos tambien la semana siguiente
        if (date("N") >= 5) {
            $nuevafecha = $this->sumarDias(date("Y-m-d"), 6);

            $semanaTarea->set('siguiente', $this->getSemanaTarea($nuevafecha));
        }

        return $semanaTarea;
    }

    public static function getNombreMes($num_mes)
    {
        switch ($num_mes) {
            case 1:
                return 'Enero';
                break;
            case 2:
                return 'Febrero';
                break;
            case 3:
                return 'Marzo';
                break;
            case 4:
                return 'Abril';
                break;
            case 5:
                return 'Mayo';
                break;
            case 6:
                return 'Junio';
                break;
            case 7:
                return 'Julio';
                break;
            case 8:
                return 'Agosto';
                break;
            case 9:
                return 'Septiembre';
                break;
            case 10:
                return 'Octubre';
                break;
            case 11:
                return 'Noviembre';
                break;
            default:
                return 'Diciembre';
                break;
        }
    }

    /*
     * Metodo para cambiar del formato Y-m-d  a d/m/Y
     *
     * @param string $fecha
     * @return fecha en formato d/m/Y
     */
    public static function cambiarFormatoEuropeo($fecha)
    {
        if ($fecha == null) {
            return '00/00/0000';
        }
        $partes = explode('-', $fecha);//se parte la fecha
        $fecha = $partes[2] . '/' . $partes[1] . '/' . $partes[0];//se cambia para que quede formato d-m-Y
        return trim($fecha);
    }

    /*
     * Metodo para cambiar del formato Y-m-d  a d-m-Y
     *
     * @param string $fecha
     * @return fecha en formato d-m-Y
     */
    public static function cambiarFormatoDB($fecha)
    {
        if ($fecha == null) {
            return '0000-00-00';
        }
        $partes = explode('/', $fecha);//se parte la fecha
        $fecha = $partes[2] . '-' . $partes[1] . '-' . $partes[0];//se cambia para que quede formato d-m-Y

        return trim($fecha);
    }

    /**
     * Obtener las abriatura para la descripciones los meses
     *
     * @param $nro
     * @return string
     */
    public static function abreviaturaMes($nro)
    {
        $mes = str_split(self::getNombreMes($nro));

        $abr = array_slice($mes, 0, 3);

        return $abr[0] . $abr[1] . $abr[2];
    }

    public static function getNombreSemana($num_semana)
    {
        switch ($num_semana) {
            case 1:
                return 'Semana 1';
                break;
            case 2:
                return 'Semana 2';
                break;
            case 3:
                return 'Semana 3';
                break;
            case 4:
                return 'Semana 4';
                break;
            case 5:
                return 'Semana 5';
                break;
            default:
                return 'Semana 6';
                break;
        }
    }
    function validar_fecha($fecha){
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $fecha)) {
            return true;
        } else {
            return false;
        }
    }
    function compararFechas($primera, $segunda)
    {
        if($this->validar_fecha($primera) == false || $this->validar_fecha($primera)== false ){
            return 0;
        }
        $valoresPrimera = explode("/", $primera);
        $valoresSegunda = explode("/", $segunda);
        $diaPrimera = $valoresPrimera[0];
        $mesPrimera = $valoresPrimera[1];
        $anyoPrimera = $valoresPrimera[2];
        $diaSegunda = $valoresSegunda[0];
        $mesSegunda = $valoresSegunda[1];
        $anyoSegunda = $valoresSegunda[2];
        $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
        $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);
        if (!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)) {
            // "La fecha ".$primera." no es válida";
            return 0;
        } elseif (!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)) {
            // "La fecha ".$segunda." no es válida";
            return 0;
        } else {
            return $diasPrimeraJuliano - $diasSegundaJuliano;
        }
    }


    // lista de ubidadciones Ocupadas para una tarea
    public static function ubicacionTarea($tarea_id)
    {
        return
            \DB::table('localizaciones')
                ->join('tarea_localizacion', 'tarea_localizacion.localizacion_id', '=', 'localizaciones.id')
                ->where('tarea_localizacion.tarea_id', $tarea_id)
                ->select('localizaciones.id', 'localizaciones.nombre')->get();


    }

    public static function sacarHoras($hora)
    {
        if($hora == null){
            return 0;
        }
        $partes=explode(':',$hora);//se parte la fecha
        return $partes[0];
    }

    public static function sacarMinutos($hora)
    {
        if($hora == null){
            return 0;
        }
        $partes=explode(':',$hora);//se parte la fecha
        return $partes[1];
    }

}
