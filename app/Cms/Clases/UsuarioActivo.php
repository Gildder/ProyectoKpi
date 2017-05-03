<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 28/04/17
 * Time: 6:37
 */

namespace ProyectoKpi\Cms\Clases;


use ProyectoKpi\Cms\Interfaces\Clases;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\SupervisoresRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;

class UsuarioActivo implements Clases {
    private $id;
    private $usuario;
    private $correo;
    private $tipo;
    private $codigo;
    private $nombre;
    private $apellido;
    private $departamento_id;
    private $localizacion_id;
    private $cargo_id;
    private $isEvaluador;
    private $isSupervisor;
    private $isIndicadores;
    private $isAdmin;

    public function __construct()
    {
        $this->inicializar();
    }

    /* Metodos */
    public function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function get($atributo){
        return $this->$atributo;
    }

    public function inicializar()
    {
        $user = \Auth::user();  //obtenemos el usuario logueado

        // datos del usuario
        $this->id = $user->id;
        $this->usuario = $user->name;
        $this->correo  = $user->email;
        $this->tipo    = $user->type;
        $this->isAdmin = $this->isAdmin();

        if (!$this->isAdmin) {
            $this->codigo = $user->empleado->codigo;
            $this->nombre = $user->empleado->nombres;
            $this->apellido = $user->empleado->apellidos;
            $this->departamento_id = $user->empleado->departamento_id;
            $this->localizacion_id = $user->empleado->localizacion_id;
            $this->cargo_id = $user->empleado->cargo;
            $this->isEvaluador = $this->isEvaluador();
            $this->isSupervisor = $this->isSupervisor();
            $this->isIndicadores = $this->isIndicadores();
        }
    }

    public function isAdmin()
    {
        $user = \Auth::user();

        if (($user['original']['name'] == 'admin') && ($user['original']['type'] == '1')) {
            return true;
        }else{
            return false;
        }
    }

    /*
	 * Verificamos si tiene asignado el Indicador de Eficacia
	*/
	public function isIndicadores()
    {
        $user = \Auth::user();

        if (!$this->isAdmin()) {
            $result = IndicadorRepository::isUserIndicador($user->empleado->cargo_id);
        }

        // dd($result, $user->empleado->cargo_id, isset($result));

         if (isset($result)) {
            return true;
        }else{
            return false;
        }
    }

    /*
     * VErificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     * gaurda en cache si es asi.
      */
    public function isEvaluador()
    {
        $result = false;
        $user = \Auth::user();

        // dd($user->empleado->cargo_id);

        if (!$this->isAdmin()) {
            $result = EvaluadoresRepository::verificarsEvaluador($user->empleado->codigo);
        }

        if (!isset($result)) {
            \Cache::forget('evadores');
            return false;
        }else{
            \Cache::forever('evadores', $result);

            return true;
        }


    }


    /**
     * Verificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     *
     */
    public function isSupervisor()
    {
        $user = \Auth::user();

        if (!$this->isAdmin()) {
            $result = SupervisoresRepository::verificarSupervisor($user->empleado->codigo);
        }

        if (!$result) {
            return false;
        }else{
            return true;
        }


    }
}