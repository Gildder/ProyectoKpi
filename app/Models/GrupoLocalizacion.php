<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class GrupoLocalizacion extends Model
{
    //
    protected $table = "grupolocalizacion";


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
        'id', 'estado','created_at', 'update_at',
    ];

}
