<?php

namespace ProyectoKpi\Models\Localizaciones;

use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\Localizaciones\GrupoDepartamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Departamento extends Model
{
    //
    protected $table = "departamentos";
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
        'nombre', 'grupodep_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','created_at', 'update_at','deleted_at',
    ];

    public function grupoDepartamento()
    {
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\GrupoDepartamento','grupodep_id');
    }

    /**
     * Retorna los departamentos perteneciente a un grupo departamento
     *
     * @var id del departamento
     */
    public static function getDepartamentos()
    {
        return Departamento::
            select('departamentos.id','departamentos.nombre as nombre','grupo_departamentos.nombre as grupo')
            ->join('grupo_departamentos','grupo_departamentos.id','=','departamentos.grupodep_id')->get();
    }

     public static function getsupervisores($id)
    {
        $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresDepartamento('.$id.')');

        return $empleadossupervisores;
    }

}
