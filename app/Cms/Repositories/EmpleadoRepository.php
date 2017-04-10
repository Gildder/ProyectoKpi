<?php

namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Indicadores\Indicador;
use Illuminate\Support\Facades\DB;


class EmpleadoRepository 
{
	
	 /**
     * [obtenerEmpleado Obtenemos los datos de un Empleado]
     * @param  [int] $id [Id del Empleado]
     * @return [Array]     [Empleado]
     */
    public static function obtenerEmpleado($id)
    {
    	return DB::table('empleados')
			->select('empleados.codigo','empleados.nombres','empleados.apellidos',
					'departamentos.grupodep_id as grdepartamento','localizaciones.nombre as localizacion','localizaciones.id as localizacion_id','departamentos.id as departamento_id',
					'departamentos.nombre as departamento','localizaciones.grupoloc_id as grlocalizacion', 
					'grupo_departamentos.nombre as grupodepartamento','grupo_localizaciones.nombre as grupolocalizacion', 
					'users.name as usuario', 'users.type as tipo','users.email', 'cargos.id as cargo_id', 'cargos.nombre as cargo'
				  )
				->join('localizaciones','localizaciones.id','=','empleados.localizacion_id')
				->join('departamentos','departamentos.id','=','empleados.departamento_id')
				->join('grupo_departamentos','grupo_departamentos.id','=','departamentos.grupodep_id')
				->join('grupo_localizaciones','grupo_localizaciones.id','=','localizaciones.grupoloc_id')
				->join('cargos','cargos.id','=','empleados.cargo_id')
				->join('users','users.id','=','empleados.user_id')
			->whereNull('empleados.deleted_at')
			->where('empleados.codigo', '=', $id)
			->first();
    }


}
