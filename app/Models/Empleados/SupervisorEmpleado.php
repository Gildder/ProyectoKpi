<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Models\Empleados\Empleado;

class SupervisorEmpleado extends Model
{
    //
    protected $table = "supervisor_empleados";
    protected $primarykey = ['supervisor_id', 'empleados_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'supervisor_id', 'empleados_id', 'created_at', 'update_at',
    ];


    public function supervisores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Empleado','supervisor_id');
    }

    public function empleados()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleados\Empleado','empleados_id');
    }

   
}
