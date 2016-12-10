<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;

class IndicadorCargo extends Model
{
    //
    protected $table = "indicadores_cargos";
    protected $primarykey = ['indicador_id', 'cargo_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'indicador_id', 'cargo_id', 'estado', 'created_at', 'update_at',
    ];


    public function indicadores()
    {
        return $this->belongsTo('ProyectoKpi\Models\IndicadorCargo','indicador_id');

    }

    public function cargos()
    {
        return $this->belongsTo('ProyectoKpi\Models\IndicadorCargo','cargo_id');
    }
}
