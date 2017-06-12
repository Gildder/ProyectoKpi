<?php

namespace ProyectoKpi\Models\Evaluadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Models\Empleados\Cargo;
use Illuminate\Support\Facades\DB;


class Evaluador extends Model
{

    protected $table = "evaluadores";
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
        'id','abreviatura', 'descripcion', 'ponderacion_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'created_at', 'update_at', 
    ];


    /* Relaciones */
    public function empleados()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Empleado','evaluador_empleados', 'evaluador_id', 'empleado_id');
    }

    public function cargos(){
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo','evaluador_cargos', 'evaluador_id', 'cargo_id');
    }

    public function ponderacion(){
        return $this->belongsTo('ProyectoKpi\Models\Evaluadores\Ponderacion','ponderacion_id');
    }

    public function indicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Indicadores\Indicador', 'evaluador_indicadores', 'indicador_id', 'evaluador_id', 'id');
    }



    public static function getCargos($id)
    {   
        $cargosEvaluados = Cargo::select('cargos.*')
                ->join('evaluador_cargos','evaluador_cargos.cargo_id','=', 'cargos.id')
                ->join('evaluadores','evaluadores.id','=','evaluador_cargos.evaluador_id')
                ->whereNull('evaluador_cargos.deleted_at')
                ->where('evaluadores.id',$id)
                ->get();


        return $cargosEvaluados;
    }

    public static function getEmpleados($id)
    {   
        $Evaluadores = Empleado::select('empleados.*')
                ->join('evaluador_empleados','evaluador_empleados.empleado_id','=', 'empleados.codigo')
                ->join('evaluadores','evaluadores.id','=','evaluador_empleados.evaluador_id')
                ->whereNull('evaluador_empleados.deleted_at')
                ->where('evaluadores.id',$id)
                ->get();


        return $Evaluadores;
    }

     public static function isCargosAgregados($evaluador_id)
    {
        $cargoAgregados = DB::select('call pa_evaluadores_cargosAgregados('.$evaluador_id.');');

        if (isset($cargoAgregados)) {
            return false;
        } else {
            return true;
        }
        
    }
   
}
