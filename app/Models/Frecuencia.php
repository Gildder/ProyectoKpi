<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Indicador;
use Yajra\Datatables\Facades\Datatables;

class Indicador extends Model
{
    //
    protected $table = "cargos";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','created_at', 'update_at',
    ];

    public function indicadores()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicador', 'cargo_id', 'id');
    }
}
