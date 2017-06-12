<?php
/**
 * Created by PhpStorm.
 * User: gildder
 * Date: 28/04/17
 * Time: 6:37
 */

namespace ProyectoKpi\Cms\Clases;

use Mockery\Exception;
use Predis\Transaction\AbortedMultiExecException;
use ProyectoKpi\Cms\Interfaces\IClases;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\SupervisoresRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Models\Evaluadores\Evaluador;

class UsuarioActivo implements IClases
{
    private $id;
    private $usuario;
    private $correo;
    private $tipo;
    private $codigo;
    private $nombre;
    private $apellido;
    private $departamento;
    private $localizacion;
    private $cargo;
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

    public function get($atributo)
    {
        if(isset($this->$atributo)){
            return $this->$atributo;
        }else{
            return 'Ninguno';
        }
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

            if (!$this->isAdmin() && $this->isEmpleado()) {
                $this->codigo = $user->codigo;
                $this->nombre = $user->nombres;
                $this->apellido = $user->apellidos;
                $this->departamento_id = $user->departamento->nombre;
                $this->localizacion_id = $user->localizacion->nombre;
                $this->cargo_id = $user->cargo->nombre;
                $this->isEvaluador = $this->isEvaluador();
                $this->isSupervisor = $this->isSupervisor();
                $this->isIndicadores = $this->isIndicadores();
            }else{
                $this->isEvaluador = false;
                $this->isSupervisor = false;
                $this->isIndicadores = false;
            }

    }

    public function isAdmin()
    {
        $user = json_decode(json_encode(\Auth::user()));

        if (($user->name == 'admin') && ($user->type == 1)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Verificamos si tiene asignado el Indicador de Eficacia
    */
    public function isIndicadores()
    {
        $user = \Auth::user();

        if (!$this->isAdmin() && $this->isEmpleado()) {
            $result = IndicadorRepository::isUserIndicador($user->cargo_id);
        }

        // dd($result, $user->cargo_id, isset($result));

         if (isset($result)) {
             return true;
         } else {
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

        // dd($user->cargo_id);

        if (!$this->isAdmin()&& $this->isEmpleado()) {
            $result = EvaluadoresRepository::cnVerificarsEvaluador($user->codigo);
        }

        if (!isset($result)) {
            \Cache::forget('evadores');
            return false;
        } else {
            \Cache::forget('evadores');
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

        if (!$this->isAdmin() && $this->isEmpleado()) {
            $result = SupervisoresRepository::verificarSupervisor($user->codigo);
        }

        if (!isset($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function isEmpleado()
    {
        $user = \Auth::user();

        try{
            if($user->hasRelation == 0){
                return false;
            }else{
                return true;
            }

            return true;
        }catch (Exception $exception){
            return false;
        }
    }
}
