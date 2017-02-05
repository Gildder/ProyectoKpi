<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


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
    public static function getLocalizaciones()
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $localizacion = DB::table('localizaciones')->where('localizaciones.id', $user->empleado->localizacion_id)->first();
        $localizaciones = DB::table('localizaciones')->where('localizaciones.grupoloc_id', $localizacion->grupoloc_id)->select('localizaciones.id','localizaciones.nombre')->get();

        return $localizaciones;
    }

}
