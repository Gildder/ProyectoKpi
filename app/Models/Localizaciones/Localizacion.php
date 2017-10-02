<?php

namespace ProyectoKpi\Models\Localizaciones;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Cms\Repositories\LocalizacionRepository;



class Localizacion extends Model
{
    //
    protected $table = "localizaciones";
    protected $primarykey = "id";

    use SoftDeletes;
    use LocalizacionRepository;
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
       'id', 'nombre', 'direccion',  'telefono',  'ciudad',  'pais',  'grupoloc_id',
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
    public function grupoLocalizacion()
    {
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\GrupoLocalizacion', 'grupoloc_id', 'id');
    }

    public function tareas()
    {
        return $this->belongsToMany('ProyectoKpi/Models/Tareas/Tarea', 'tarea_localizacion', 'tarea_id', 'localizacion_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('ProyectoKpi\Models\User', 'localizacion_id');
    }

}
