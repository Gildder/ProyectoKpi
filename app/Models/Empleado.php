<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table = "empleado";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellidoPaterno', 'apellidoMaterno','correo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','estado', 'departamento_id', 'localizacion_id', 'created_at', 'update_at',
    ];

}
