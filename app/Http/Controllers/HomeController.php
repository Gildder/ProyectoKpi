<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Http\Requests;
use Illuminate\Http\Request;
use ProyectoKpi\Models\Empleados\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use ProyectoKpi\Cms\repositories\SupervisoresRepository;
use ProyectoKpi\Cms\repositories\EvaluadoresRepository;
use ProyectoKpi\Models\Controllers\Tareas\TareaProgramadaController;
use ProyectoKpi\Cms\Repositories\TareaRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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
        if(! Auth::guest()){
            if (Auth::user()->isAdmin()) {

                return redirect()->route('administrador.index');

            }else{
                // direccionamso a las tareas programadas
                SupervisoresRepository::isSupervisor();
                EvaluadoresRepository::isEvaluador();

                return redirect()->route('tareas.tareaProgramadas.index');

            }
        }

    }

}
