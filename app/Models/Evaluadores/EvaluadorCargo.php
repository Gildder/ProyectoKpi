<?php

namespace ProyectoKpi\Models\Evaluadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use ProyectoKpi\Models\Empleados\Evaluador;
use ProyectoKpi\Models\Empleados\Cargo;


class EvaluadorCargo extends Model
{
    protected $table = "evaluador_cargos";
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
        'cargo_id', 'evaluador_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'update_at',
    ];


    /* Metodos de Repositorio*/
   public static function getEvaluadores()
    {
        return Evaluador::select('evaluadores.*')
                ->join('evaluador_cargos','evaluador_cargos.evaluador_id','=','evaluadores.id')
                ->get();
    }
}
