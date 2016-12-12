<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;
use ProyectoKpi\Models\IndicadorPrimerEmpleado;
use Yajra\Datatables\Facades\Datatables;

class IndicadorPrimerEmpleado extends Model
{
    protected $table = "indicador_primer";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gestion', 'mes', 'semana', 'actpro',  'actrea', 'efeser', 
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

    public function empleados()
    {
        return $this->belongsToMany('ProyectoKpi\Models\Empleado','indicadores_cargos', 'indicador_id', 'cargo_id');
    }
}
