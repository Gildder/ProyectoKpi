<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Empleados\Empleado;
use Yajra\Datatables\Facades\Datatables;

class Empleado extends Model
{
    //
    protected $table = "empleados";
    protected $primarykey = "codigo";
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo','nombres', 'apellidos', 'departamento_id', 'localizacion_id','cargo_id','user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'estado', 'created_at', 'update_at',
    ];

    function users(){
        return $this->hasOne('ProyectoKpi\User');
    }

    function cargos(){
        return $this->belongsTo('ProyectoKpi\Models\Empleados\Cargo');
    }
    
    function departamentos(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Departamento');
    }

    function localizaciones(){
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\Localizacion');
    }

    //Indicadores
    public function primer_indicador()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\IndicadorPrimer');
    }

}
