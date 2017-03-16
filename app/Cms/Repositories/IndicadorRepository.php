<?php

namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Cms\Repositories\PrimerIndicadorRepository;
use ProyectoKpi\Cms\Repositories\EficienciaIndicadorRepository;

    
class IndicadorRepository 
{
	  /*contructores */
    public function __construct()
    {
       
    }
    

    /* Metodos */

	/**
	 * Retorn la lista de indicadores para un Empleado
	 */
	public static function getIndicadoresEmpleado($codigo)
	{
	    return Empleado::select('indicadores.id', 'indicadores.nombre', 'indicadores.orden', 'indicadores.descripcion_objetivo','tipos_indicadores.nombre as tipo', 'indicador_cargos.objetivo', 'indicador_cargos.condicion', 'indicador_cargos.aclaraciones', 'frecuencias.nombre as freciencia')
	            ->join('indicador_cargos','indicador_cargos.cargo_id','=','empleados.cargo_id')
	            ->join('indicadores','indicadores.id','=','indicador_cargos.indicador_id')
	            ->join('tipos_indicadores','tipos_indicadores.id','=','indicadores.tipo_indicador_id')
	            ->join('frecuencias','frecuencias.id','=','indicador_cargos.frecuencia_id')
	            ->where('empleados.codigo',$codigo)
	            ->get();
	}

	public static function getTablaIndicador($emp_id, $ind_id)
	{
		switch ($ind_id) {
			case '1':
				return PrimerIndicadorRepository::getPrimerIndicador($emp_id);
				break;
			case '2':
				return EficienciaIndicadorRepository::getEficienciaIndicador($emp_id);
				break;
			
		}
	}

	public static function getGraficoIndicador($emp_id, $ind_id)
	{
		switch ($ind_id) {
			case '1':
				return PrimerIndicadorRepository::getPrimerIndicadorChart($emp_id);
				break;
			case '2':
				return EficienciaIndicadorRepository::getEficienciaIndicadorChart($emp_id);
				break;
			
		}
	}


}
