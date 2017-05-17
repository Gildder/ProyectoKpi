<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
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

    /* Relaciones */
    function user(){
        return $this->belongsTo('ProyectoKpi\Models\User','user_id');
    }

    function cargo(){
        return $this->belongsTo('ProyectoKpi\Models\Empleados\Cargo');
    }
    
    function departamento(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Departamento');
    }

    function localizacion(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Localizacion');
    }

    public function tareas()
    {
        return $this->hasMany('ProyectoKpi\Models\Tareas\Tarea', 'empleado_id', 'id');
    }

    public function supervisores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Empleado', 'supervisores_empleados', 'supervisor_id', 'empleado_id', 'codigo');
    }

    //    relacion supervisores con Cargos
    public function cargos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo', 'supervisor_cargos', 'empleado_id', 'cargo_id', 'id');
    }

    // relacion de supervisor departamentos
    public function departamentos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Localizaciones\Localizacion', 'supervisor_departamentos', 'empleado_id', 'departamento_id', 'id');

    }

    public function eficaciaIndicadores()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\EficaciaIndicador', 'empleado_id', 'codigo');
    }

    /* Metodos Repositorio */
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
