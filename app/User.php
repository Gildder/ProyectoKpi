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
        'id','name', 'email', 'password','state',  'active',  'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
          'password', 'remember_token',
    ];


    public function empleado()
    {
        return $this->hasOne('ProyectoKpi\Models\Empleados\Empleado');
    }

    public function tipo()
    {
        return $this->belongsTo('ProyectoKpi\Models\Empleados\TipoUsuario','type');
    }


    public function isAdmin()
    {
        return $this->type == '1';
    }


}
