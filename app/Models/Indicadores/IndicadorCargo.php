<?php

namespace ProyectoKpi\Models\Indicadores;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Support\Facades\DB;
use ProyectoKpi\Models\Indicadores\Indicador;

class IndicadorCargo extends Model
{
    //
    protected $table = "indicador_cargos";
    protected $primarykey = ['indicador_id', 'cargo_id'];

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
        'condicion', 'aclaraciones',  'objetivo',   'indicador_id', 'cargo_id', 'frecuencia_id', 
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at',
    ];


    public function indicadores()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicador','indicador_id');

    }

    public function cargos()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\Cargo','cargo_id');
    }


    /*Metodos Repositorios */

    /**
     + Obtener Indicadores 
     */

     public static function getIndicadores()
     {
        $indicadores = Indicador::
            select('indicadores.id', 'indicadores.nombre','indicadores.descripcion_objetivo' , 'tipo_indicadores.nombre as tipo')
            ->join('tipo_indicadores','tipo_indicadores.id','=','indicadores.tipo_indicador_id');


        return $indicadores;
     }
}
