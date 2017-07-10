<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 05/07/2017
 * Time: 04:00 PM
 */

namespace ProyectoKpi\Cms\Repositories;


class ConfiguracionRepositorio
{

    public static function getGenerarSemanasAnuales($anio)
    {
        $semanasMeses =  \DB::select('call pa_cantidadSemanasAnual('.$anio.');');

        for($mes=1; $mes <=12 ; $mes++){
            $semanas = \DB::select('call pa_cantidadSemanasAnual('.$anio.');');

            foreach ($semanas as $semana) {

            }


        }
         \DB::select('call ('.$anio.')pa_generarFechasSemanalAnual;');


         return 'true';
    }

    public function cargarPrimerIndicador()
    {
        
    }
    
}
