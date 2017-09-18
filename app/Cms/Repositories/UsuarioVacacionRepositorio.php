<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 16/08/2017
 * Time: 1:08
 */

namespace ProyectoKpi\Cms\Repositories;


use ProyectoKpi\Models\Empleados\UsuarioVacacion;
use ProyectoKpi\Models\User;

class UsuarioVacacionRepositorio
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

    public static function isEntreVacacion($fechaInicio, $fechaFin, $user_id)
    {
        $vacacion = \DB::select("call pa_usuario_tieneVacaciones('".$fechaInicio."', '".$fechaFin."', ".$user_id."); ");

        return $vacacion[0]->resultado;
    }
}
