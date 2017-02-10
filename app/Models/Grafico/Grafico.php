<?php

namespace ProyectoKpi\Models\Grafico;


use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grafico extends Model
{

  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mes','semana1','semana2','semana3','semana4',
    ];

  
}
