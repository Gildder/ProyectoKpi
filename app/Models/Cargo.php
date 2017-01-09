<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Cargo;
use Yajra\Datatables\Facades\Datatables;

class Cargo extends Model
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

    public function empleados()
    {
        return $this->hasMany('ProyectoKpi\Models\Empleado', 'cargo_id', 'id');
    }


    public function indicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Indicador','indicadores_cargos', 'cargo_id', 'indicador_id');
    }

}
