<?php

namespace ProyectoKpi\Http\Controllers;

use ProyectoKpi\Http\Requests;
use Illuminate\Http\Request;
use ProyectoKpi\Models\Empleados\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
        
        $user = Auth::user();
        if ($user->type != '1') {
            $result = Empleado::isSupervisor();
        }
        
        return view('home');
    }
}
