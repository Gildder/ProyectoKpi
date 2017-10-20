<?php

namespace ProyectoKpi\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Cms\Repositories\Entity;
use ProyectoKpi\Models\Tareas\Tarea;

class TareaHistoricoProceso extends Model
{
    use  SoftDeletes;
    use Entity;

    protected $table = 'tarea_historico_estado_proceso';
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tarea_id', 'estado', 'fecha'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    function tarea() {
        return $this->belongsTo(Tarea::getClass());
    }


}
