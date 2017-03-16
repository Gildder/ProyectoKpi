<?php

namespace ProyectoKpi\Models\Localizaciones;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Models\Localizaciones\Localizacion;


class Localizacion extends Model
{
    //
    protected $table = "localizaciones";
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
       'id', 'nombre', 'direccion',  'telefono',  'ciudad',  'pais',  'grupoloc_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];

    public function grupoLocalizaciones()
    {
        return $this->belongsTo(grupoLocalizacion::class);
    }


    public static function getLocalizaciones()
    {

        return Localizacion::select('localizaciones.id','localizaciones.nombre','localizaciones.direccion','localizaciones.telefono','grupo_localizaciones.nombre as grupo')->join('grupo_localizaciones','grupo_localizaciones.id','=','localizaciones.grupoloc_id')->get();
    }

}
