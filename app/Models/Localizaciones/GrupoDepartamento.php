<?php

namespace ProyectoKpi\Models\Localizaciones;


use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Localizaciones\Departamento;
use Yajra\Datatables\Facades\Datatables;

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


    protected $guarded = ['id'];

    public function departamentos()
    {
        return $this->hasMany('ProyectoKpi\Models\Localizaciones\Departamento');
    }


    public static function validarRepetido()
    {

    }
}
