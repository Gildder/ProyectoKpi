<?php

namespace ProyectoKpi\Cms\Clases;

class Semana
{
    /*Atributos*/

    /*contructores */
    public function __construct()
    {

    }
    // /* Metodos */

    /** retorna un arreglos de fecha de inicio y fin de la semana */
    function inicioFinSemana($fecha){

        $diaInicio="Monday";
        $diaFin="Sunday";

        $strFecha = strtotime($fecha);

        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));

        if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }
        return Array("fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin);
    }


    /* obtener el numero de dias de un mes */
    function numeroDiasMes($fecha)
    {
        $Month = date('n', strtotime($fecha));
        $Year = date('Y', strtotime($fecha));
       //Si la extensión que mencioné está instalada, usamos esa.
       if( is_callable("cal_days_in_month"))
       {
          return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
       }
       else
       {
          //Lo hacemos a mi manera.
          return date("d",mktime(0,0,0,$Month+1,0,$Year));
       }
    }


    /* retorna la semana de una fecha */
    function mesSemanaFecha($fecha)
    {
        $fechas = $this->inicioFinSemana($fecha);
        //mes de inicio de semana
        $anio = date("Y", strtotime($fechas['fechaInicio']));
        $mes = date("n", strtotime($fechas['fechaInicio']));
        $semana = $this->numeroSemanaFecha($fechas['fechaInicio']);
        $diasMes = $this->numeroDiasMes($fechas['fechaInicio']);
        $diaActual = date("j",strtotime($fechas['fechaInicio']));

        $diasRestantes = $diasMes - $diaActual;

        if ($diasRestantes < 4) {
            //mes de fin de semana
            $mes = date("n", strtotime($fechas['fechaFin']));
            $semana = $this->numeroSemanaFecha($fechas['fechaFin']);
        } 

        return array('anio'=>$anio,'mes'=>$mes, 'semana'=>$semana, 'fechaInicio'=>$fechas['fechaInicio'], 'fechaFin'=>$fechas['fechaFin']);
    }

    /* retorna la semana de una fecha */
    function numeroSemanaFecha($fecha)
    {
        // Calculamos la semana del mes
        $semanaInicioMes =  date("W",strtotime(date("Y-m-01", strtotime($fecha))));
        $semanaActualFecha =  date("W",strtotime($fecha)) ;

        $result = $semanaActualFecha - $semanaInicioMes;

        if($result == 0) {
            if(date('j', strtotime($fecha)) > 4)
                return $result + 1;
        }
        
        return $result;
    }

    function sumarDias($fecha, $dias)
    {
        $nuevafecha = strtotime ( '+'.$dias.' day' , strtotime($fecha) ) ;
        $nuevafecha = date('Y-m-d', $nuevafecha);
        return $nuevafecha;
    }

    /* Retorna la semanas habilitadas*/
    function getSemanasProgramadas($fecha)
    {
        // Nro del dia de la semana
        $diaActual = date("N");

        //Si es Viernes = 5
        if($diaActual >= 7 ){
           $estaSemana = $this->mesSemanaFecha($fecha);
           $nuevafecha = $this->sumarDias(date("Y-m-d"), 6);
           $siguienteSemana = $this->mesSemanaFecha($nuevafecha);
           return array($estaSemana,$siguienteSemana);
        }else{
           $estaSemana = $this->mesSemanaFecha($fecha);
           return array($estaSemana);
        }

    }

    static function getNombreMes($num_mes)
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


}