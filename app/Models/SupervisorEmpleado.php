<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany('ProyectoKpi\Models\Empleado','supervisor_id');
    }

    public function empleados()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleado','empleados_id');
    }
}
