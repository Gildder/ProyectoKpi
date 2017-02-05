<?php

namespace ProyectoKpi\Models\Tareas;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Proyecto extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates 
     *  
     * @var array
     */
    protected $dates = ['deleted_at'];

    //
    protected $table = "proyectos";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'fechaInicio', 'fechaFin', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'update_at','deleted_at',
    ];

     function tareas(){
        return $this->belongsTo('ProyectoKpi\Models\Tareas\Tarea');
    }
    
}
