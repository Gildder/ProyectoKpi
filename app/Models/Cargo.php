<?php

namespace ProyectoKpi\Models;


use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //
    protected $table = "cargos";
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

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }


    public function indicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Inidicador','indicadores_cargos', 'indicador_id', 'cargo_id');
    }

}
