<?php

namespace ProyectoKpi\Http\Controllers\Admin;

use \Httpful\Request;
use Mockery\Exception;
use ProyectoKpi\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador/dashboard');
    }

    public function importarldap()
    {

        try{

            $uri = "http://localhost:2000/api/ClientesLdap";
            $response = Request::get($uri)
                ->expectsType('json')
                ->send();

//            foreach ($response->body->ticket as $item)
//            {
//            }
//            dd(json_encode($response->body));
            return [
                'success' => true
            ];

        }catch (Exception $e){
            return [
                'success' => false
            ];
        }

    }
}
