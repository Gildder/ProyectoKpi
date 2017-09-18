<?php

namespace ProyectoKpi\Models\Evaluadores;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use SoftDeletes;

    protected $table = "evaluador_widget";
    protected $primarykey = "id";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'evaluador_id',
        'user_id',
        'tipo_id',
        'titulo',
        'isSemanal',
        'tipoIndicador_id',
        'indicador_id',
        'anio',
        'mesInicio',
        'mesBuscado',
        'mesTarea',
        'semanaTarea',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function ultimoMes(){
        return date('n');
    }
}
