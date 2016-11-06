<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    //
    protected $table = "localizaciones";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'direccion',  'telefono',  'ciudad',  'pais',  'grupoloc_id',
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
