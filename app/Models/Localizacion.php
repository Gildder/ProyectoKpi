<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    //
    protected $table = "localizacion";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'direccion',  'telefono',  'ciudad',  'pais',  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','grupoloc_id','created_at', 'update_at',
    ];

}
