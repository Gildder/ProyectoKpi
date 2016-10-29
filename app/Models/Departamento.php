<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $table = "departamento";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','grupodep_id','created_at', 'update_at',
    ];
}
