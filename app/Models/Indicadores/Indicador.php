<?php

namespace ProyectoKpi\Models\Indicadores;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use ProyectoKpi\Cms\Repositories\IndicadorRepository;


class Indicador extends Model
{
    //
    protected $table = "indicadores";
    protected $primarykey = "id";

    public $timestamps = true;

    use SoftDeletes;
    use IndicadorRepository;

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
        'id','nombre', 'orden', 'descripcion',  'tipo_indicador_id',  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];


    protected $guarded = ['id'];

    /* Relaciones */
    public function cargos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo','indicadores_cargos', 'indicador_id', 'cargo_id');
    }

    public function tipo()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\TipoIndicador','tipo_indicador_id');
    }

    public function ponderaciones()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Evaluadores\Evaluador', 'indicador_ponderacion', 'ponderacion_id', 'indicador_id', 'id')
            ->withPivot('ponderacion');
    }

    public function evaluadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Evaluadores\Evaluador', 'evaluador_indicadores', 'indicador_id', 'evaluador_id', 'id');
    }

    public function eficaciaIndicadores()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\EficaciaIndicador', 'indicador_id', 'id');
    }

}
