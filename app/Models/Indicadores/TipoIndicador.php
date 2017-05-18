<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Empleados\Cargo;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class TipoIndicador extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates 
     *  
     * @var array
     */
    protected $dates = ['deleted_at'];

    //
    protected $table = "tipos_indicadores";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];

    public function indicadores()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\Indicador');
    }

    public function ponderaciones()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Evaluadores\Ponderacion','ponderaciones',  'tipoIndicador_id','ponderacion_id','id' );

    }


    public function getFondo($tipo)
    {
        switch ($tipo) {
            case '1':
                return 'bg-aqua';
                break;
            case '2':
                return 'bg-green';
                break;
            case '3':
                return 'bg-yellow';
                break;
            default:
                return 'bg-red';
                break;
        }
    }
    

    public function getIcon($tipo)
    {
        switch ($tipo) {
            case '1':
                return 'fa fa-gear';
                break;
            case '2':
                return 'fa fa-leaf';
                break;
            case '3':
                return 'fa fa-bank';
                break;
            default:
                return 'fa fa-child';
                break;
        }
    }
    
}
