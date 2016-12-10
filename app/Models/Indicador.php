<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Indicador;
use Yajra\Datatables\Facades\Datatables;

class Indicador extends Model
{
    //
    protected $table = "Indicadores";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'objetivo', 'valorobjetivo', 'condicion', 'frecuencia', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','created_at', 'update_at',
    ];


    protected $guarded = ['id'];

    public function cargos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Cargo','indicadores_cargos', 'indicador_id', 'cargo_id');
    }
}
