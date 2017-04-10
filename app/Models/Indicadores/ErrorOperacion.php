<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;

class ErrorOperacion extends Model
{
    protected $table = "error_operaciones";
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
        'id','tarea_id', 'estado', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];


    protected $guarded = ['id'];

    public function notas()
    {
        return $this->hasMany('ProyectoKpi\Models\Indicadores\NotaError', 'errorop_id', 'id');
    }

}
