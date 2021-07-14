<?php

namespace ProyectoKpi\Models\Procesos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ProyectoKpi\Cms\Repositories\Entity;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\User;


class OpcionAprobacion extends Model
{
    use SoftDeletes;
    use Entity;

    protected $table = 'opcion_aprobaciones';
    protected $primarykey = 'id';
    public $timestamps = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'habilitado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'update_at','deleted_at',
    ];

    public function evaluadores()
    {
        return $this->belongsToMany(Evaluador::getClass(),
            'opcion_aprobacion_evaluadores',
            'evaluador_id',
            'opcion_id',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::getClass());
    }

}
