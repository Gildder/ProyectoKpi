<?php

namespace ProyectoKpi\Models\Indicadores;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



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
        'indicador_id', 'evaluadorIndicador_id', 'cargo_id', 'evaluadorCargo_id', 'evaliador','condicion', 'aclaraciones',  'objetivo',   'indicador_id', 'cargo_id', 'frecuencia_id',
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
    public function indicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Indicadores\Indicadores','evaluador_indicadores', 'indicador_id', 'evaluador_id', 'id');

    }

    public function evaluadorIndicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Evaluadores\Evaluador','evaluador_indicadores', 'indicador_id', 'evaluador_id', 'id');

    }

    public function cargos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo','evaluador_cargos', 'cargo_id', 'evaluador_id', 'id');

    }

    public function evaluadorCargos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Evaluadores\Evaluador','evaluador_cargos', 'cargo_id', 'evaluador_id', 'id');

    }

    public function frecuencia()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\Frecuencia', 'frecuencia_id', null, 'id');
    }


    /*Metodos Repositorios */

    /**
     + Obtener Indicadores 
     */

     public static function getIndicadoresCargos()
     {
        $indicadores = Indicador::
            select('indicadores.id', 'indicadores.nombre','indicadores.descripcion_objetivo' , 'tipo_indicadores.nombre as tipo')
            ->join('tipo_indicadores','tipo_indicadores.id','=','indicadores.tipo_indicador_id');


        return $indicadores;
     }
}
