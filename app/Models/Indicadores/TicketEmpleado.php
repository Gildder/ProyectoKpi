<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;

class TicketEmpleado extends Model
{
    protected $table = "ticket_empleados";
    protected $primarykey = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','empleado_id', 'tecnico__id', 'ticket_abiertos', 'ticket_cerrados',  'semana_tipo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];

    /* Relaciones */
    public function tipoSemana()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\TipoEmpleado');

    }

    public function empleado()
    {
        return $this->belongsTo('ProyectoKpi\Models\Empleados\Empleado');

    }
}
