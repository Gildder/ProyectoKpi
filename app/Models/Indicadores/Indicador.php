<?php

namespace ProyectoKpi\Models\Indicadores;


use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Database\Eloquent\SoftDeletes;

use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Empleados\Cargo;

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
        'nombre', 'orden', 'descripcion_objetivo',  'tipo_indicador_id',  
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

    public function tipo()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\TipoIndicador','tipo_indicador_id');
    }


    /* Metodo Repsoitorio */
    public static function getCargos($id)
    {   
        $cargosindicadores = Cargo::select('cargos.*')
                ->join('indicador_cargos','indicador_cargos.cargo_id','=', 'cargos.id')
                ->join('indicadores','indicadores.id','=','indicador_cargos.indicador_id')
                ->whereNull('indicador_cargos.deleted_at')
                ->where('indicadores.id',$id)
                ->get();

        return $cargosindicadores;
    }
}
