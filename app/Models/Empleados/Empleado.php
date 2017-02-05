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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

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
        return $this->belongsTo('ProyectoKpi\User','user_id');
    }

    function cargos(){
        return $this->belongsTo('ProyectoKpi\Models\Empleados\Cargo');
    }
    
    function departamentos(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Departamento');
    }

    function tareas(){
        return $this->belongsTo('ProyectoKpi\Models\Tareas\Tarea');
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
    public static function isSupervisor()
    {
        $user = Auth::user();//obtenemos el usuario logueado
        
        $result = Empleado::
            select('empleados.codigo')
            ->join('supervisor_departamentos','supervisor_departamentos.empleado_id','=','empleados.codigo')
            ->where('supervisor_departamentos.empleado_id', '=', $user->empleado->codigo)
            ->count();

        if ($result > 0 ) {
            Cache::forever('depasores', encrypt($user->empleado->codigo));
        }else{
            Cache::forever('depasores', '');
        }

        return $result;
    }

}
