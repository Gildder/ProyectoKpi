<?php

namespace ProyectoKpi\Models\Indicadores;


use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Indicadores\Indicador;
use Yajra\Datatables\Facades\Datatables;

class Indicador extends Model
{
    //
    protected $table = "indicadores";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'orden', 'descripcion_objetivo', 'objetivo',  'tipo_indicador_id', 'condicion', 'frecuencia', 
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
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo','indicadores_cargos', 'indicador_id', 'cargo_id');
    }
}
