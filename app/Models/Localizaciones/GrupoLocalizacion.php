<?php

namespace ProyectoKpi\Models\Localizaciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupoLocalizacion extends Model
{
    //
    protected $table = "grupo_localizaciones";
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
        'id','nombre', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];

    public function localizaciones()
    {
        return $this->hasMany('ProyectoKpi\Models\Localizaciones\Localizacion' , 'grupoloc_id', 'id');
    }

}
