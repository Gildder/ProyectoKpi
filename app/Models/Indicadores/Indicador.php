<?php

namespace ProyectoKpi\Models\Indicadores;


use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Indicadores\Indicador;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicador extends Model
{
    //
    protected $table = "indicadores";
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
        'nombre', 'orden', 'descripcion_objetivo', 'objetivo',  'tipo_indicador_id', 'condicion', 'frecuencia', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','created_at', 'update_at',
    ];


    protected $guarded = ['id'];

    public function cargos()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo','indicadores_cargos', 'indicador_id', 'cargo_id');
    }
}
