<?php

namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


use ProyectoKpi\Models\Empleados\Cargo;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Cms\repositories\SupervisoresRepository;
use ProyectoKpi\Cms\repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\repositories\IndicadorRepository;


class UserRepository 
{

	 /*contructores */
    public function __construct()
    {
    }

    public static function isAdmin()
    {
    	$user = Auth::user(); //obtenemos el usuario logueado

    	if (($user['original']['name'] == 'admin') && ($user['original']['type'] == '1')) {
            return true;
        }

        return false;
    }

    /*
	 * Verificamos si tiene asignado el Indicador de Eficacia
	*/
	public static function isEficaciaIndicador($indicador_id)
	{
        $result = false;
    	$user = Auth::user(); 
        $admin = UserRepository::isAdmin();

        if (!$admin) {
        	$result = IndicadorRepository::isUserIndicador($indicador_id, $user->empleado->cargo_id);
        }

        if (!$result) {
            Cache::forget('iseficacia');
        }else{
            Cache::forever('iseficacia', $result);
        }

	}

    /* 
     * VErificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     * gaurda en cache si es asi.
      */
    public static function isEvaluador()
    {
        $result = false;
    	$user = Auth::user(); 
          $admin = UserRepository::isAdmin();

        if (!$admin) {
        	$result = EvaluadoresRepository::isEvaluador($user->empleado->codigo);
        }

        if (!$result) {
            Cache::forget('evadores');
        }else{
            Cache::forever('evadores', $result);
        }
            

    }


    /**
     * Verificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     *
     */
    public static function isSupervisor()
    {
    	$result = false;
    	$user = Auth::user(); 
        $admin = UserRepository::isAdmin();

        if (!$admin) {
        	$result = SupervisoresRepository::isSupervisor($user->empleado->codigo);
        }

        if (!$result) {
            Cache::forget('depasores');
        }else{
            Cache::forever('depasores', $result);
        }
            

    }

}
