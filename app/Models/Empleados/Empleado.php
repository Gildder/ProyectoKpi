<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Database\wrong;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;


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

    public function getCargo($id)
    {
        $cargo =  DB::table('cargos')->select('cargos.nombre')->where('cargos.id',$id)->first();

        return $cargo->nombre;
    }






     public static function getTablaIndicador($emp_id, $ind_id)
    {
        return IndicadorRepository::getTablaIndicador($emp_id, $ind_id);
    }

    public static function getGraficoIndicador($emp_id, $ind_id)
    {
        return IndicadorRepository::getGraficoIndicador($emp_id, $ind_id);
    }
}
