<?php

namespace ProyectoKpi;

use Illuminate\Database\Eloquent\Model;

class IndicadorPrimer extends Model
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
        return $this->belongsTo('ProyectoKpi\Models\Empleado','emp_codigo');
    }
}
