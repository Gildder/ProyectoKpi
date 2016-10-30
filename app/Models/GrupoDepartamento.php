<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class GrupoDepartamento extends Model
{
    //
    protected $table = "grupodepartamento";

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
