<?php

namespace ProyectoKpi\Cms\Repositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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

	/**
     * Lista d eindicadores asignado a Gerencia evaluadora
     * 
     * @param  id de Indicador
     */
	public function getIndicadoresDeEvaluadores($evaluador_id)
	{
		$result = DB::table('indicadores i')
            ->join('evalaudor_indicadores ei','ei.indicador_id', '=', 'i.id')
            ->join('tipos_indicadores ti','ti.id', '=', 'i.tipo_indicador_id')
            ->where('ei.evaluador_id', $evaluador_id)
            ->select('i.id', 'i.nombre', 'i.descripcion', 'ti.nombre as tipo')
            ->get();

        return json_encode($result);
	}


	/**
     * Verifica si un indicador esta asignado a cargo
     * 
     * @param  id de Indicador
     * @param  id de Cargo
     * @return boolean
     */
	public static function isUserIndicador($indicador_id, $cargo_id)
	{
		$result = DB::table('indicador_cargos')->select('indicador_cargos.cargo_id')
            ->where('indicador_cargos.cargo_id', $cargo_id)
            ->where('indicador_cargos.indicador_id', $indicador_id)
            ->count();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
	}
	

}
