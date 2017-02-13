<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;


use ProyectoKpi\Clases\Semana;


class Tarea extends Model
{

    protected $table = "tareas";
    protected $primarykey = "id";
    
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
        'descripcion', 'fechaInicioEstimado', 'fechaFinEstimado', 'tiempoEstimado', 'fechaInicioSolucion', ' fechaFinSolucion', 'tiempoSolucion', 'estado', ' tipo', 'proyecto_id', 'empleado_id','localizacion_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'update_at', 'deleted_at',
    ];

    public function empleados()
    {
        return $this->hasMany('ProyectoKpi\Models\Empleados\Empleado', 'empleado_id');
    }

    function proyectos(){
        return $this->hasMany('ProyectoKpi\Models\Tareas\Proyecto', 'proyecto_id');
    }

    /* ;Metodos de repositorio */

    // Las localizaciones de disponibles para un empleado particular
    public static function getLocalizaciones()
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();
        $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();

        return $localizaciones;
    }

    // lista de ubidadciones Ocupadas para una tarea
    public static function ubicacionesOcupadas($tarea_id)
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();
        // $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();
        $ubicacionesOcupadas = DB::table('localizaciones')->join('tarea_realizadas','tarea_realizadas.localizacion_id','=', 'localizaciones.id')
                                ->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)
                                ->where('tarea_realizadas.tarea_id',$tarea_id)
                                ->select('localizaciones.id','localizaciones.nombre')->get();


        return $ubicacionesOcupadas;
    }

    // lista de ubidadciones disponbiles para una tarea
    public static function ubicacionesDisponibles($tarea_id)
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();

        $ubicacionesDisponible  = DB::select('call pa_tareas_ubicaionesDisponibles('.$localizacion->grupoloc_id.','.$tarea_id.');');

        return $ubicacionesDisponible;
    }

    public static function getEstado($tarea_id)
    {
        $tarea = Tarea::findOrFail($tarea_id);

        if ($tarea->estado == '1') {
            return 'Programado';
        }elseif ($tarea->estado == '2') {
            return 'En Proceso';
        }elseif ($tarea->estado == '3') {
            return 'Finalizado';
        }
    }

    public static function listSemana()
    {
        $semana = new Semana();
        return  $semana->getSemanasProgramadas();
    }


}
