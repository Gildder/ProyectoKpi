<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;


class Empleado extends Model
{
    //


    protected $table = "empleados";
    protected $primarykey = "codigo";

    use SoftDeletes;
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates 
     *  
     * @var array
     */
    protected $dates = ['deleted_at'];
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo','nombres', 'apellidos', 'departamento_id', 'localizacion_id','cargo_id','user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];

    function users(){
        return $this->hasOne('ProyectoKpi\User');
    }

    function cargos(){
        return $this->belongsTo('ProyectoKpi\Models\Empleados\Cargo');
    }
    
    function departamentos(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Departamento');
    }

    function localizaciones(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Localizacion');
    }

    //Indicadores
    public function primer_indicador()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\IndicadorPrimer');
    }



    // /* Metodos de Repositorio */
    // /**
    //  * [TodosEmpleados Obtenemos la lista de todos los empleados]
    //  */
    // public static function todosEmpleados()
    // {
    //     return Empleado::
    //         select('empleados.codigo','empleados.nombres','empleados.apellidos','localizaciones.nombre as localizacion','departamentos.nombre as departamento', 'users.name as usuario','users.email as correo', 'cargos.nombre as cargo')
    //             ->join('localizaciones','localizaciones.id','=','empleados.localizacion_id')
    //             ->join('departamentos','departamentos.id','=','empleados.departamento_id')
    //             ->join('cargos','cargos.id','=','empleados.cargo_id')
    //             ->join('users','users.id','=','empleados.user_id')
    //         ->whereNull('empleados.deleted_at')->get();
    // }

    // /**
    //  * [obtenerEmpleado Obtenemos los datos de un Empleado]
    //  * @param  [int] $id [Id del Empleado]
    //  * @return [Array]     [Empleado]
    //  */
    // public static function obtenerEmpleado($id)
    // {
    //     return Empleado::
    //         select('empleados.codigo','empleados.nombres','empleados.apellidos',
    //                 'departamentos.grupodep_id as grdepartamento','localizaciones.nombre as localizacion','localizaciones.id as localizacion_id','departamentos.id as departamento_id',
    //                 'departamentos.nombre as departamento','localizaciones.grupoloc_id as grlocalizacion', 
    //                 'grupo_departamentos.nombre as grupodepartamento','grupo_localizaciones.nombre as grupolocalizacion', 
    //                 'users.name as usuario', 'users.type as tipo','users.email', 'cargos.id as cargo_id', 'cargos.nombre as cargo'
    //               )
    //             ->join('localizaciones','localizaciones.id','=','empleados.localizacion_id')
    //             ->join('departamentos','departamentos.id','=','empleados.departamento_id')
    //             ->join('grupo_departamentos','grupo_departamentos.id','=','departamentos.grupodep_id')
    //             ->join('grupo_localizaciones','grupo_localizaciones.id','=','localizaciones.grupoloc_id')
    //             ->join('cargos','cargos.id','=','empleados.cargo_id')
    //             ->join('users','users.id','=','empleados.user_id')
    //         ->where('empleados.codigo', '=', $id)
    //         ->whereNull('empleados.deleted_at')
    //         ->first();
    // }


    // /**
    //  * [obtenerIndicadores Obtenemos la Lista de Indicadores de un empleado]
    //  * @param  [type] $id [Id Empleado]
    //  * @return [type]     [description]
    //  */
    // public static function obtenerIndicadores($codigo)
    // {
    //     return Empleado::
    //         select('indicadores.id','indicadores.orden','indicadores.nombre','indicadores.descripcion_objetivo','indicadores.objetivo','tipos_indicadores.nombre as tipo','indicadores.condicion',  'frecuencias.nombre as frecuencia')
    //             ->join('cargos','cargos.id','=','empleados.cargo_id')
    //             ->join('indicadores_cargos','indicadores_cargos.cargo_id','=','cargos.id')
    //             ->join('indicadores','indicadores.id','=','indicadores_cargos.indicador_id')
    //             ->join('frecuencias','frecuencias.id','=','indicadores.frecuencia_id')
    //             ->join('tipos_indicadores','tipos_indicadores.id','=','indicadores.tipo_indicador_id')
    //         ->where('empleados.codigo','=', $codigo)
    //         ->whereNull('indicadores.deleted_at')
    //         ->first();
    // }


    // public static function obtenerIndicadoresDisponibles($id,$idCargo)
    // {
    //     $indicadores = $this->obtenerIndicadores($id);
        
    //     $cargos_indicador = Cargo::find($idCargo)->indicadores()->where('indicadores_cargos.cargo_id','=', $idCargo)->get();

    //     $todos_indicadores = Indicador::select('indicadores.id','indicadores.orden','indicadores.nombre','indicadores.descripcion_objetivo','indicadores.objetivo','tipos_indicadores.nombre as tipo','indicadores.condicion',  'frecuencias.nombre as frecuencia')
    //                         ->join('frecuencias','frecuencias.id','=','indicadores.frecuencia_id')
    //                         ->join('tipos_indicadores','tipos_indicadores.id','=','indicadores.tipo_indicador_id')
    //                     ->whereNull('empleados.deleted_at')
    //                     ->get();

    //     return $todos_indicadores->diff($cargos_indicador);

    // }

}
