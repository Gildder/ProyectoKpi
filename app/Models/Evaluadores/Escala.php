<?php

namespace ProyectoKpi\Models\Evaluadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Escala extends Model
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
    protected $table = "escalas_cumplimiento";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'orden', 'color',  'fondo', 
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
    public function ponderaciones()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Evaluadores\Ponderacion', 'escala_ponderacion', 'ponderacion_id', 'escala_id', 'id')
            ->withPivot('maximo', 'minimo');
    }
}
