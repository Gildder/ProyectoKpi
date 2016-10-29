<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class TareaLocalizacion extends Model
{
    //
    protected $table = "tarealocalizacion";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'tarea_id', 'localizacion_id', 'created_at', 'update_at',
    ];
}
