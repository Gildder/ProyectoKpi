<?php

namespace ProyectoKpi\Cms\Repositories;

use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\User;

class EmpleadoRepository
{
    
    /**
     * [obtenerEmpleado Obtenemos los datos de un Empleado]
     * @param  [int] $id [Id del Empleado]
     * @return [Array]     [Empleado]
     */
    public static function obtenerEmpleado($id)
    {
        return User::select(
				'users.id','users.codigo', 'users.nombres', 'users.apellidos', 'users.color','users.active','users.vacacion','users.tecnico_id',
                'departamentos.grupodep_id as grdepartamento', 'localizaciones.nombre as localizacion',
				'localizaciones.id as localizacion_id', 'departamentos.id as departamento_id',
                'departamentos.nombre as departamento', 'localizaciones.grupoloc_id as grlocalizacion',
                'grupo_departamentos.nombre as grupodepartamento', 'grupo_localizaciones.nombre as grupolocalizacion',
                'users.name as usuario', 'users.type as tipo', 'users.email as correo', 'cargos.id as cargo_id',
				'cargos.nombre as cargo'
            )
            ->leftJoin('localizaciones', 'localizaciones.id', '=', 'users.localizacion_id')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'users.departamento_id')
            ->leftJoin('grupo_departamentos', 'grupo_departamentos.id', '=', 'departamentos.grupodep_id')
            ->leftJoin('grupo_localizaciones', 'grupo_localizaciones.id', '=', 'localizaciones.grupoloc_id')
            ->leftJoin('cargos', 'cargos.id', '=', 'users.cargo_id')
            ->whereNull('users.deleted_at')
            ->where('users.id', '=', $id)
            ->first();
    }

    public static function getCargosDeSupervisados($get)
    {
        return User::select(
            ''
        );
    }

    public function obtenerIndicadoresDisponibles($id, $idCargo)
    {
        $indicadores = $this->obtenerIndicadores($id);
        
        $cargos_indicador = Cargo::find($idCargo)->indicadores()->where('indicadores_cargos.cargo_id', '=', $idCargo)->get();

        $todos_indicadores = Indicador::select('indicadores.id', 'indicadores.orden', 'indicadores.nombre', 'indicadores.descripcion_objetivo', 'indicadores.objetivo', 'tipos_indicadores.nombre as tipo', 'indicadores.condicion', 'frecuencias.nombre as frecuencia')
                            ->join('frecuencias', 'frecuencias.id', '=', 'indicadores.frecuencia_id')
                            ->join('tipos_indicadores', 'tipos_indicadores.id', '=', 'indicadores.tipo_indicador_id')
                        ->whereNull('users.deleted_at')
                        ->get();

        return $todos_indicadores->diff($cargos_indicador);
    }

    public static function obtenerLista()
    {
        return User::select(
            'users.id', 'users.name as usuario','users.codigo', 'users.nombres', 'users.apellidos', 'users.active','users.color',
            'departamentos.grupodep_id as grdepartamento', 'localizaciones.nombre as localizacion', 'localizaciones.id as localizacion_id', 'departamentos.id as departamento_id',
            'departamentos.nombre as departamento', 'localizaciones.grupoloc_id as grlocalizacion',
            'grupo_departamentos.nombre as grupodepartamento', 'grupo_localizaciones.nombre as grupolocalizacion',
            'users.name as usuario', 'users.type as tipo', 'users.email as correo', 'cargos.id as cargo_id', 'cargos.nombre as cargo'

        )
            ->leftJoin('localizaciones', 'localizaciones.id', '=', 'users.localizacion_id')
            ->leftJoin('departamentos', 'departamentos.id', '=', 'users.departamento_id')
            ->leftJoin('grupo_departamentos', 'grupo_departamentos.id', '=', 'departamentos.grupodep_id')
            ->leftJoin('grupo_localizaciones', 'grupo_localizaciones.id', '=', 'localizaciones.grupoloc_id')
            ->leftJoin('cargos', 'cargos.id', '=', 'users.cargo_id')
            ->get();
    }


}
