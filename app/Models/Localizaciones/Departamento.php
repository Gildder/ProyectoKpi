<?php

namespace ProyectoKpi\Models\Localizaciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Cms\Repositories\DepartamentoRepository;


class Departamento extends Model
{
    use SoftDeletes;
    use DepartamentoRepository;

    //
    protected $table = "departamentos";
    protected $primarykey = "id";


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
        'id', 'nombre', 'grupodep_id',
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
    public function grupoDepartamento()
    {
        return $this->belongsTo('ProyectoKpi\Models\Localizaciones\GrupoDepartamento','grupodep_id');
    }

    public function users()
    {
        return $this->hasMany('ProyectoKpi\Models\User', 'departamento_id');
    }
}
