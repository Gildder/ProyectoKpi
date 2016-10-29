<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $table = "proyecto";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'fechaInicioEstimado', 'fechaFinEstimado', 'fechaInicioReal', 'fechaFinReal', 'tiempoTrabajo', 'tiempoTrabajoReal','observacion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','created_at', 'update_at',
    ];

}
