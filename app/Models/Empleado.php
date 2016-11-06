<?php

namespace ProyectoKpi\Models;



use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table = "empleados";
    protected $primarykey = "id";
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'nombre', 'apellidoPaterno', 'apellidoMaterno','correo', 'departamento_id', 'localizacion_id','cargo_id','user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','estado', 'created_at', 'update_at',
    ];

}
