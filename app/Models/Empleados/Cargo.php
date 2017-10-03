<?php

namespace ProyectoKpi\Models\Empleados;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Cms\Repositories\CargoRepository;


class Cargo extends Model
{
    use SoftDeletes;
    use CargoRepository;

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


    
}
