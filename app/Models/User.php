<?php

namespace ProyectoKpi\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use ProyectoKpi\Cms\repositories\UserRepository;

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

    /* Relaciones */
    public function empleado()
    {
        return $this->hasOne('ProyectoKpi\Models\Empleados\Empleado');
    }

    public function tipo()
    {
        return $this->belongsTo('ProyectoKpi\Models\Empleados\TipoUsuario','type');
    }

    public function user()
    {
        return $this->hasOne('ProyectoKpi\Models\Empleados\Empleado', 'user_id');
    }

    public function isAdmin()
    {
        return $this->type == '1';
    }

    /* Relaciones */



}
