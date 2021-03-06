<?php

namespace ProyectoKpi\Models\Evaluadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Ponderacion extends Model
{

    protected $table = "ponderaciones";
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
       'id', 'nombre', 'descripcion'
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
    public function ponderaciones()
    {
        return $this->hasMany('ProyectoKpi\Models\Evaluadores\Ponderacion', 'ponderacion_id', 'id');
    }

    public function tipoIndicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Indicadores\TipoIndicador','tipo_ponderaciones', 'ponderacion_id', 'tipoIndicador_id','id' )->withPivot('ponderacion');
    }


    public function escalaCumplimientos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Evaluadores\Escala', 'escala_ponderacion', 'ponderacion_id', 'escala_id', 'id')
                    ->withPivot('maximo', 'minimo');
    }

    public function indicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Indicadores\Indicador', 'indicador_ponderacion', 'ponderacion_id', 'indicador_id', 'id')
                    ->withPivot('ponderacion');
    }



    /*Metodos Repositorio */
    public function ponderacionIndicador($id)
    {
        $result = DB::table('indicador_ponderacion')
                    ->select(DB::raw('sum(indicador_ponderacion.ponderacion) as ponderacion'))
                    ->where('indicador_ponderacion.ponderacion_id',$id)
                    ->get();

        if (is_null($result)) {
            return 100;
        } else {
            return (100 - $result[0]->ponderacion);
        }
        
    } 

    public function ponderacionTipo($id)
    {
        $ponderacion = 100;
        $result = DB::table('tipo_ponderaciones')
                    ->select(DB::raw('sum(tipo_ponderaciones.ponderacion) as ponderacion'))
                    ->where('tipo_ponderaciones.ponderacion_id',$id)
                    ->get();

        if (!is_null($result)) {
            $ponderacion = $ponderacion - $result[0]->ponderacion;

        }
        // dd($ponderacion);
        return $ponderacion;
        
    } 

}
