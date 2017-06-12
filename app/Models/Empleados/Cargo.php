<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cargo extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates 
     *  
     * @var array
     */
    protected $dates = ['deleted_at'];

    //
    protected $table = "cargos";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];

    /* Relaciones */
    public function users()
    {
        return $this->hasMany('ProyectoKpi\Models\User', 'cargo_id');
    }


    public function indicadores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Indicadores\Indicador','indicadores_cargos', 'cargo_id', 'indicador_id');
    }

    public function supervisores()
    {
        return $this->belongsToMany('ProyectoKpi\Models\User', 'supervisor_cargos', 'supervisor_id', 'cargo_id', 'id');
    }




    /* Metodos Repsoitorios */
    public static function getsupervisores($id)
    {
        $empleadossupervisores = DB::select('call pa_supervisores_empleadosSupervisadoresCargo('.$id.')');

        return $empleadossupervisores;
    }

    
}
