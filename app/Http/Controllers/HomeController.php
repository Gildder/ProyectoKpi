<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Http\Requests;
use Illuminate\Http\Request;
use ProyectoKpi\Models\Empleados\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use ProyectoKpi\Cms\repositories\UserRepository;
use ProyectoKpi\Models\Controllers\Tareas\TareaProgramadaController;
use ProyectoKpi\Cms\Repositories\TareaRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller <instance class=""></instance>
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutaPrincipal = 'empleados.perfil.index';

        if(! Auth::guest()){
            if (Auth::user()->isAdmin()) {
                return redirect()->route('administrador.index');
            }else{
                // tiene indicadores asignado
                if(UserRepository::isIndicadores()){
                    $rutaPrincipal = 'tareas.tareaProgramadas.index';
                }   

// dd(UserRepository::isSupervisor());

                if(UserRepository::isSupervisor()){
                    $rutaPrincipal = 'supervisores.supervisados.index';
                }

                if (UserRepository::isEvaluador()) {
                    $rutaPrincipal = 'evaluadores.evaluados.dashboard';
                }
               
                return redirect()->route($rutaPrincipal);

            }
        }

    }

}
