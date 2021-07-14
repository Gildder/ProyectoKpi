<?php
/**
 * Created by PhpStorm.
 * User: gguerrero
 * Date: 03/10/2017
 * Time: 10:08 AM
 */

namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Database\Eloquent\Model;

trait Entity
{
    public static function getClass()
    {
        return get_class(new static());
    }
}
