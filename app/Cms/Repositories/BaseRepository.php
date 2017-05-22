<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 16/05/2017
 * Time: 06:26 PM
 */

namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected function modeloAObjeto(Model $modelo)
    {
        return json_encode($modelo);
    }
}
