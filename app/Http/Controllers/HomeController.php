<?php

namespace ProyectoKpi\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use ProyectoKpi\Cms\Clases\Caches;
use ProyectoKpi\Cms\Clases\Conexion_LDAP;
use ProyectoKpi\Cms\Repositories\ConfiguracionRepositorio;
use ProyectoKpi\Cms\Semanas\SemanaTarea;
use ProyectoKpi\Http\Requests;
use Illuminate\Http\Request;
use ProyectoKpi\Models\Empleados\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use ProyectoKpi\Cms\repositories\UserRepository;
use ProyectoKpi\Http\Controllers\Tareas\TareaProgramadaController;
use ProyectoKpi\Cms\Repositories\TareaRepository;
use ProyectoKpi\Cms\Clases\FiltroTabla;

class HomeController extends Controller
{
    /**
     * Create a new controller <instance class=""></instance>
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->iniciaDatos();

        $rutaPrincipal = 'empleados.perfil.index';
        if (! Auth::guest()) {
            if (\Usuario::get('isAdmin')) {
                return redirect()->route('administrador.index');
            } else {
//                dd(\Auth::user()->is_evaluador);
                // tiene indicadores asignado
                if (\Usuario::get('isIndicadores')) {
                    $rutaPrincipal = 'tareas.tareaProgramadas.index';
                }

                if (\Usuario::get('isSupervisor')) {
                    $rutaPrincipal = 'supervisores.supervisados.index';
                } else {
                    $rutaPrincipal = 'empleados.perfil.index';
                }

                if (\Usuario::get('isEvaluador')) {
                    $rutaPrincipal = 'evaluadores.evaluados.dashboard';
                }
//
                return redirect()->route($rutaPrincipal);
            }
        }
    }


    public function iniciaDatos()
    {
        $semana = new SemanaTarea();
        $semanaDB = $semana->buscarSemanaDB(Carbon::now());

        Caches::guardar('inicioSemana', $semanaDB->fechaInicio);
        Caches::guardar('finSemana', $semanaDB->fechaFin);
    }
}
