<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;

class TipoSemana extends Model
{
    protected $table = "tipo_semanas";
    protected $primarykey = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','tipo', 'anio', 'mes', 'fecha_inicio',  'fecha_fin'
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
    public function ticketEmpleados()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\TicketEmpleado','semana_tipo_id', null, 'id');

    }
}
