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
use ProyectoKpi\Cms\Repositories\TareaRepository;
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
    private $evaluador_id;
    private $isSupervisor;
    private $isIndicadores;
    private $isAdmin;
    private $preferencias;

    public function __construct(PreferenciasUsuario $preferencias)
    {
        $this->inicializar();
        $this->preferencias = $preferencias;
    }

    /** Metodos */
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
            $this->departamento_id = $user->departamento_id;
            $this->localizacion_id = $user->localizacion_id;
            $this->cargo_id = $user->cargo_id;

        }
        $this->isEvaluador = $this->isEvaluador();
        $this->isSupervisor = $this->isSupervisor();
        $this->isIndicadores = $this->isIndicadores();
    }

    public function isAdmin()
    {
        $user = json_decode(json_encode(\Auth::user()));
        $eliminarTarea = TareaRepository::getDiaLimiteEliminar();

        if (($user->name == 'admin') && ($user->type == 1)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verificamos si tiene asignado el Indicador de Eficacia
    */
    public function isIndicadores()
    {
        $user = \Auth::user();
        if (!$this->isAdmin()) {
            $result = IndicadorRepository::isUserIndicador($user->cargo_id);
        }

//         dd( $user->cargo_id, isset($result));

         if (isset($result)) {
             return true;
         } else {
             return false;
         }
    }

    /**
     * VErificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     * gaurda en cache si es asi.
    */
    public function isEvaluador()
    {
        try{
            $user = \Auth::user();

            if (!$this->isAdmin()) {
                if (isset($user->is_evaluador)) {
                    $result = EvaluadoresRepository::cnVerificarsEvaluador($user->id);
                    \Cache::forget('evadores');
                    \Cache::forever('evadores', $result);

                    return true;
                } else {
                    \Cache::forget('evadores');
                    return false;
                }
            }
        }catch (Exception $e){
            Debugbar::error('Error: '.$e.', UsuarioActivo->isEvaluador!');
        }

    }


    /**
     * Verificar si el usuario logueado esata asignado como supervisor de otro emplaedo
     *
     */
    public function isSupervisor()
    {
        try{

            $user = \Auth::user();

            if (!$this->isAdmin()) {
                if (isset($user->is_supervisor)) {
                    return true;
                } else {
                    return false;
                }
            }

        }catch (Exception $e){
            Debugbar::error('Error: '.$e.', UsuarioActivo->isSupervisor!');

        }
    }

    private function isEmpleado()
    {
        $user = \Auth::user();

        if(isset($user->codigo) || isset($user->nombres) || isset($user->apellidos) || isset($user->departamento->nombre) ||
            isset($user->localizacion->nombre)|| isset($user->cargo->nombre)){
            return true;
        }else{
            return false;
        }
    }

}
