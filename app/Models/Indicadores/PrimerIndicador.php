<?php

namespace ProyectoKpi\Models\Indicadores;

use Illuminate\Database\Eloquent\Model;

class PrimerIndicador extends Model
{
    protected $table = "primer_indicador";
    protected $primarykey = ['id'];

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gestion', 'mes', 'semana', 'actpro',  'actrea', 'efeser', 'emp_codigo', 'indicador_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','created_at', 'update_at',
    ];


    public function indicadores()
    {
        return $this->belongsTo('ProyectoKpi\Models\Indicadores\Indicador','id');

    }
  
}
