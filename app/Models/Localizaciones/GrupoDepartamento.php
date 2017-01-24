<?php

namespace ProyectoKpi\Models\Localizaciones;


use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Localizaciones\Departamento;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoDepartamento extends Model
{
    //
    protected $table = "grupo_departamentos";
    protected $primarykey = "id";

    use SoftDeletes;
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates 
     *  
     * @var array
     */
    protected $dates = ['deleted_at'];


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
        'id','created_at', 'update_at','deleted_at',
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
