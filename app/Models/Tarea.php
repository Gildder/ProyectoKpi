<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //
    protected $table = "tarea";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'fechaInicioEstimado', 'fechaFinEstimado', 'fechaInicioReal', 'fechaFinReal', 'tiempoTrabajo', 'tiempoTrabajoReal','observacion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','proyecto_id', 'empleado_id','created_at', 'update_at',
    ];
}
