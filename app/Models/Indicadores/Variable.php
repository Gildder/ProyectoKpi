<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Variable extends Model
{

    protected $table = "variables";
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

/*Metodos Repositorio */



    public static function getCargos($id)
    {   
        $cargos = '';
        
        $cargosEvaluados = Cargo::select('cargos.*')
                ->join('evaluador_cargos','evaluador_cargos.cargo_id','=', 'cargos.id')
                ->join('_TablaMes','evaluadores.id','=','evaluador_cargos.evaluador_id')
                ->whereNull('evaluador_cargos.deleted_at')
                ->where('evaluadores.id',$id)
                ->get();


        foreach ($cargosEvaluados as $p) {
            $cargos =   $p->nombre . '; '.$cargos  ;
        }

        return $cargosEvaluados;
    }
   
}
