<?php

namespace ProyectoKpi\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $table = "departamentos";
    protected $primarykey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'grupodep_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'estado','created_at', 'update_at',
    ];

    public function grupoDepartamento()
    {
        $this->belongsTo(GrupoDepartamento::class);
    }
}
