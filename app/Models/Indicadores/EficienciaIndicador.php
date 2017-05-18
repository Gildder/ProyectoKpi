<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;

class EficaciaIndicador extends Model
{
    protected $table = "eficiencia_indicador";
    protected $primarykey = ['id'];

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','gestion', 'mes', 'semana', 'totope',  'numerr', 'efeact', 'empleado_id', 'indicador_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'created_at', 'update_at',
    ];

    /* Relaciones */
    public function indicador()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\Indicador','indicador_id', null, 'id');

    }

    public function empleado()
    {
        return $this->belongsTo('ProyectoKpi\Models\Empleados\Empleado','empleado_id', null, 'codigo');

    }


  
}
