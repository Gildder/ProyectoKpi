<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use function print_r;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Clases\Tiempo;
use ProyectoKpi\Cms\Repositories\Entity;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Models\Api\TareaEstadoTiempo;
use ProyectoKpi\Models\Api\TareaHistoricoProceso;
use function strtotime;


class Tarea extends Model
{

    use SoftDeletes;
    use Entity;
    use TareaRepository;

    protected $table = "tareas";
    protected $primarykey = "id";

    /* agrego los datos del repositorio */
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
        'id','numero','descripcion', 'fechaInicioEstimado', 'fechaFinEstimado', 'tiempoEstimado', 'fechaInicioSolucion', ' fechaFinSolucion', 'tiempoSolucion', 'estadoTarea_id', ' tipoTarea_id', 'proyecto_id', 'user_id','localizacion_id', 'hora', 'minuto', 'observaciones'
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
    public function users()
    {
        return $this->hasMany('ProyectoKpi\Models\User', 'user_id');
    }

    function proyectos(){
        return $this->hasMany('ProyectoKpi\Models\Tareas\Proyecto', 'proyecto_id');
    }

    function estados(){
        return $this->belongsTo('ProyectoKpi\Models\Tareas\Estados','estadoTarea_id');

    }

    public function  notaErrores()
    {
        return $this->hasMany('ProyectiKpi/Models/Tareas/Tarea', 'tarea_id', 'id');
    }

    public function localizaciones()
    {
        return $this->belongsToMany('ProyectoKpi/Models/Localizaciones/Localizacion', 'tarea_localizacion', 'tarea_id', 'localizacion_id', 'id');
    }

    public function estadoTiempo()
    {
        return $this->hasMany(TareaEstadoTiempo::getClass());
    }

    public function tareahistoricos()
    {
        return $this->hasMany(TareaHistoricoProceso::getClass());
    }
}
