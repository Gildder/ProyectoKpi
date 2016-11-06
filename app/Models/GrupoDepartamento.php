<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;

class GrupoDepartamento extends Model
{
    //
    protected $table = "grupo_departamentos";
    protected $primarykey = "id";

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


    public function departamento()
    {
        $this->hasMany(Departamento::class);
    }

}
