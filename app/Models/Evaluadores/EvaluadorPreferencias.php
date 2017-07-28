<?php

namespace ProyectoKpi\Models\Evaluadores;

use Illuminate\Database\Eloquent\Model;

class EvaluadorPreferencias extends Model
{
    protected $table = "evaluador_empleados";
    protected $primarykey = "empleado_id";

    use SoftDeletes;
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
        'empleado_id', 'evaluador_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'update_at',
    ];
}
