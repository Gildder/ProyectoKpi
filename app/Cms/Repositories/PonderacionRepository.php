<?php

namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Indicadores\TipoIndicador;

    
class PonderacionRepository 
{
	  /*contructores */
    public function __construct()
    {
       
    }
    

    /* Metodos */

	/**
	 * $id es llave primaria de Gerencia evaluadora
	  *
	 * Retorn la lista de indicadores para un Empleado
	 */
	public static function getTipoIndicadores($id)
	{
	    return TipoIndicador::select('ponderaciones.id as pon_id', 'ponderaciones.ponderacion', 'tipos_indicadores.id as tipo_id', 'tipos_indicadores.nombre as tipoIndicador')
	    	->join('ponderaciones', 'ponderaciones.tipoIndicador_id', '=', 'tipos_indicadores.id')
	    	->where('evaluador_id','=', $id)
	    	->get();
	}


}
