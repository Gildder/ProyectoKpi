<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Cms\Repositories\EstadoRepository;

class Estados extends Model
{
    use EstadoRepository;

    protected $table = "estado_tareas";
    protected $primarykey = "id";

//    use SoftDeletes;
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre','descripcion', 'color', 'texto', 'habilitarCalendario', 'visiblePorEmpleado', 'solucion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at', 'deleted_at',
    ];


    /* Relaciones */
    public function tareas()
    {
        return $this->hasMany('ProyectoKpi\Models\Tareas\Tarea', 'estadoTarea_id', 'id');
    }

}
