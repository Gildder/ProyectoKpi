<?php

namespace ProyectoKpi;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  'password',  'state',  'active',  'type', 'remember_token',
    ];


    public function empleado()
    {
        return $this->hasOne('ProyectoKpi\Models\Empleados\Empleado');
    }
}
