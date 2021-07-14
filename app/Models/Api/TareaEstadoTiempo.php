<?php

namespace ProyectoKpi\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Cms\Repositories\Entity;
use ProyectoKpi\Models\Tareas\Estados;
use ProyectoKpi\Models\Tareas\Tarea;

class TareaEstadoTiempo extends Model
{
    use  SoftDeletes;
    use Entity;

    protected $table = 'tarea_estado_tiempos';
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tarea_id', 'estado_id', 'total_tiempo_ultima_actualizacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];


    /* Relaciones a Modelos */
    function tarea() {
        return $this->belongsTo(Tarea::getClass());
    }

    function estado()
    {
        return $this->belongsTo(Estados::getClass());
    }

}
