<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;

class Evaluador extends Model
{
	protected $table = "evaluadores";
    protected $primarykey = "id";
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'abreviatura', 'descripcion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','estado', 'created_at', 'update_at',
    ];

    public function empleados()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Empleado','evaluador_empleados', 'evaluador_id', 'empleado_id');
    }

    function cargos(){
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Cargo','evaluador_cargos', 'evaluador_id', 'cargo_id');
    }
}
