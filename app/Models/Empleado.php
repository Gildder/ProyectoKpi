<?php

namespace ProyectoKpi\Models;



use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Empleado;
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
        'codigo','nombres', 'apellidos', 'grdepartamento_id','departamento_id', 'grlocalizacion_id','localizacion_id','cargo_id','user_id',
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
        return $this->belongsTo('ProyectoKpi\Models\Cargo');
    }
    
    function departamentos(){
        return $this->belongsTo('ProyectoKpi\Models\Departamento');
    }

    function localizaciones(){
        return $this->belongsTo('ProyectoKpi\Models\Localizacion');
    }

    //Indicadores
    public function primer_indicador()
    {
        return $this->hasMany('ProyectoKpi\Models\IndicadorPrimer');
    }

}
