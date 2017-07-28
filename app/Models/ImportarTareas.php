<?php

namespace ProyectoKpi\Models;

use Illuminate\Database\Eloquent\Model;

class ImportarTareas extends Model
{
    protected $table = 'importar_tareas';
    protected $primarykey = ['id'];


    protected $fillable = ['id', 'tecnico','tareas','minutos','fechaInicio','fechaFin','estado','tienda','observacion'];
}
