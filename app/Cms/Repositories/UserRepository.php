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
    public static function isIndicadores()
    {
        $user = Auth::user();
        $admin = UserRepository::isAdmin();

        if (!$admin) {
            $result = IndicadorRepository::isUserIndicador($user->empleado->cargo_id);
        }

        if (!$result) {
            Cache::forget('iseficacia');
            return false;
        } else {
            Cache::forever('iseficacia', $result);

            return true;
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
            $result = EvaluadoresRepository::cnVerificarsEvaluador($user->empleado->codigo);
        }

        // dd(isset($result), $result);

        if (!isset($result)) {
            Cache::forget('evadores');
            return false;
        } else {
            Cache::forever('evadores', $result);

            return true;
        }
    }


    /**
     * Verificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     *
     */
    public static function isSupervisor()
    {
        $user = Auth::user();
        $admin = UserRepository::isAdmin();

        if (!$admin) {
            $result = SupervisoresRepository::verificarSupervisor($user->empleado->codigo);
        }

        if (!$result) {
            Cache::forget('depasores');
            return false;
        } else {
            Cache::forever('depasores', $result);
            return true;
        }
    }
}
