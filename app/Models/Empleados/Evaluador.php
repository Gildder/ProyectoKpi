<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Models\Empleados\Evaluador;
use ProyectoKpi\Models\Empleados\Cargo;


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
        'abreviatura', 'descripcion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'update_at',
    ];

    public function empleados()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Empleado','evaluador_empleados', 'evaluador_id', 'empleado_id');
    }

    function cargos(){
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo','evaluador_cargos', 'evaluador_id', 'cargo_id');
    }

/*Metodos Repositorio */



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
   
}
