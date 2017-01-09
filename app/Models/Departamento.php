<?php

namespace ProyectoKpi\Models;

use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\GrupoDepartamento;

class Departamento extends Model
{
    //
    protected $table = "departamentos";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'grupodep_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','created_at', 'update_at',
    ];

    public function grupoDepartamento()
    {
        return $this->belongsTo('ProyectoKpi\Models\GrupoDepartamento','grupodep_id');
    }

    /**
     * Retorna los departamentos perteneciente a un grupo departamento
     *
     * @var id del departamento
     */
    public static function obtenerDepartamento($id)
    {
        return Departamento::where('grupodep_id','=', $id)->where('estado','=', '1')->get();
    }

}
