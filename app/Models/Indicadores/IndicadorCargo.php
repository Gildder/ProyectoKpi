<?php

namespace ProyectoKpi\Models\Indicadores;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndicadorCargo extends Model
{
    //
    protected $table = "indicadores_cargos";
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'indicador_id', 'cargo_id', 'created_at', 'update_at',
    ];


    public function indicadores()
    {
        return $this->belongsTo('ProyectoKpi\Models\IndicadorCargo','indicador_id');

    }

    public function cargos()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\IndicadorCargo','cargo_id');
    }
}
