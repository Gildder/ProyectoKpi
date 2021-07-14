<?php

namespace ProyectoKpi\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Configuracion\ConexionLdap;

class LdapController extends Controller
{
    public function index()
    {
        $conexiones = ConexionLdap::all();
        return view('configuraciones.ldap.index', ['conexiones' => $conexiones]);
    }

    public function create()
    {
        return view('configuraciones.ldap.create');
    }
}
