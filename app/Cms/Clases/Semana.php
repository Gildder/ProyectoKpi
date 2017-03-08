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

    /* retorna la semana del mes de la fecha actual */
    function numeroSemanaMes()
    {
        return $weekNum = date("W") - date("W",strtotime(date("Y-m-01"))) + 1;
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
        $diaActual = date("d",strtotime($fechas['fechaInicio']));

        $diasRestantes = $diasMes - $diaActual;
// print_r($diasMes.'-'.$diaActual.'='.$diasRestantes.';  ');

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
        $var1 =  date("W",strtotime(date("Y-m-01", strtotime($fecha)))) + 1;
        $var2 =  date("W",strtotime($fecha)) + 1;

        $result = $var2 - $var1;
        
        return $result + 1;
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




}