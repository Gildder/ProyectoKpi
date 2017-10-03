<?php

namespace ProyectoKpi\Models\Evaluadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Cms\Repositories\EvaluadorRepository;
use ProyectoKpi\Models\Empleados\Cargo;
use Illuminate\Support\Facades\DB;


class Evaluador extends Model
{

    use SoftDeletes;
    use EvaluadorRepository;

    protected $table = "evaluadores";

    protected $primarykey = "id";
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
    public function users()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Users','evaluador_empleados', 'evaluador_id', 'user_id');
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

}
