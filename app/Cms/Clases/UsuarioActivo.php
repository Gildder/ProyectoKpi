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
    private $is_eficacia;
    private $isAdmin;
    private $indicadores;
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
//        if(isset($this->$atributo)){
            return $this->$atributo;
//        }else{
//            return 'Ninguno';
//        }
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
        $this->is_eficacia = $user->is_eficacia;
        $this->indicadores = $this->indicadorAsignados($user->id);

        if (!$this->isAdmin() && $this->isEmpleado()) {
            $this->codigo = $user->codigo;
            $this->nombre = $user->nombres;
            $this->apellido = $user->apellidos;
            $this->departamento = $user->departamento;
            $this->localizacion = $user->localizacion;
            $this->cargo = $user->cargo;

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

    public function indicadorAsignados($usuario_id)
    {
        $indicadores = \DB::select('call pa_empleados_obtenerIndicadores(\''.$usuario_id.'\');');

        $lista = array();
        foreach ($indicadores as $indicador){
            array_push($lista, $indicador->id);
        }

        return $lista;
    }

    public function is_indicador($indicador)
    {
        $position =  array_search($indicador, $this->indicadores);

        if($position == true || isset($position)){
            return true;
        }else{
            return false;
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

    public function getThis()
    {
        return $this;
    }

}
