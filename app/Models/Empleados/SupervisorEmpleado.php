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

     /* Metodos de Repositorio*/

     // Obtenemos todos los indicadores de un empleado 
   public static function getIndicadores($codigo)
    {
        return Empleado::select('indicadores.*')
                ->join('indicador_cargos','indicador_cargos.cargo_id','=','empleados.cargo_id')
                ->join('indicadores','indicadores.id','=','indicador_cargos.indicador_id')
                ->where('empleados.codigo',$codigo)
                ->get();
    }
}
