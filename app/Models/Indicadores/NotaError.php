<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;

class NotaError extends Model
{
   
    protected $table = "nota_errores";
    protected $primarykey = ['errorop_id', 'tarea_id'];

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
        'errorop_id','tarea_id', 'estadoNota', 'descripcion', 'empleado_id', 
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

    /* Relaciones */
    public function cargos()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\ErrorOperacion');
    }

    public function tarea()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\NotaError', 'tarea_id', null, 'id');
    }

    public function supervisor()
    {
        return $this->belongsTo('ProyectoKpi/Models/Empleados/Empleado', 'supervisor_id', null, 'codigo');
    }

}
