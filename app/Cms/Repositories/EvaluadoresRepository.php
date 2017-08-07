<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use PhpParser\Node\Expr\Cast\Object_;
use ProyectoKpi\Cms\Clases\TablaMes;
use ProyectoKpi\Cms\Clases\TablaSemana;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Cms\Clases\IndicadorReporte;
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Evaluadores\Widget;
use ProyectoKpi\Models\User;
use stdClass;

class EvaluadoresRepository extends BaseRepository
{

    /*contructores */
    private static $evaluador;

    public function __construct()
    {
    }

    /**
     * Obtenemos la lista de los empleados que son evaludor por una gerencia
     *
     */
    public static function cnGetEvaluados($evaluador_id, $empleado_id)
    {
        return  DB::table('evaluador_cargos')
            ->select('users.codigo', 'users.nombres', 'users.apellidos', 'departamentos.nombre as departamento', 'users.name as usuario', 'users.email as correo', 'cargos.nombre as cargo', 'evaluadores.descripcion as gerencia')
            ->leftjoin('cargos', 'cargos.id', '=', 'evaluador_cargos.cargo_id')
            ->leftjoin('users', 'users.cargo_id', '=', 'evaluador_cargos.cargo_id')
            ->leftjoin('departamentos', 'departamentos.id', '=', 'users.departamento_id')
            ->leftjoin('users', 'users.id', '=', 'users.user_id')
            ->leftjoin('evaluadores', 'evaluadores.id', '=', 'evaluador_cargos.evaluador_id')
            ->leftjoin('evaluador_empleados', 'evaluador_empleados.evaluador_id', '=', 'evaluador_cargos.evaluador_id')
            ->where('users.id', '<>', $empleado_id)
            ->where('evaluador_empleados.evaluador_id', $evaluador_id)
            ->get();
    }


    /**
     * Retorna los datos de un Indicador de un Mes por Semana
     *
     */
    public static function cnGetIndicadoresSemana($evaluador, $indicador, $anio, $mes)
    {
        return \DB::select('call pa_evaluados_procesosSemana(' . $evaluador . ', ' . $indicador . ', ' . $anio . ', ' . $mes . ');');
    }


    /**
     * Retorna las los totales primer indicador 'Eficacia de idicador' para los empleados
     * 
     */
    public static function cnGetIndicadoresEmpeladosSemana($indicador, $usuario, $anio, $mes)
    {
        return \DB::select('call pa_evaluados_empleadosSemana(' . $indicador . ', ' . $usuario . ', ' . $anio . ', ' . $mes . ');');
    }


    /**
     * Retorna los datos de la eficacia por empleados, tareas y ticket
     *
     */
    public static function cnGetIndicadoresTareasSemana($usuario, $anio, $mes, $semana=null)
    {
        return \DB::select('call pa_evaluados_tareasSemana(' . $usuario . ', ' . $anio . ', ' . $mes . ', ' . $semana . ');');
    }

    /**
     * cantidad de semanas por un mes
     * @param $mes
     */
    public static function getObtenerCantidadSemanas($mes)
    {
        return \DB::select('call pa_cantidadSemanasMes('.$mes.');');
    }


    //// NO ESTA IMPLEMENTADO EL PROCEDIMEINTO ALMACENDO
    public static function getObtenerFechasemanas($semana)
    {
        return \DB::select('call pa_fechasSemanasTareas('.$semana.');');
    }

    /**
     * Devuelve los empleados evaluados con sus evaluacion para un indicador particular.
     *
     */
    public function cnGetEmpleadosSemana($indicador, $evaluador, $anio, $mes)
    {
        $lista = array();

        $user_evaluados = \DB::select('call pa_evaluadores_empleadosEvaluados('.$indicador.','.$evaluador.');');

        foreach ($user_evaluados as $user_evaluado) {
            $usuario_con_evaluaciones = new \stdClass();

            $usuario_con_evaluaciones->id = $user_evaluado->id;
            $usuario_con_evaluaciones->nombre = $user_evaluado->nombres.' '.$user_evaluado->apellidos;

            // obtenemos las evaluaciones por semanas del empleados actual para el mes indicador
            $evaluaciones = \DB::select('call pa_evaludados_empleadosSemana(' . $indicador . ', '.$user_evaluado->id.', ' . $anio . ', ' . $mes . ');');

            // agregar las evaluaciones a un atributo del empleado
            $usuario_con_evaluaciones->evaluaciones = $evaluaciones;

            array_push($lista, $usuario_con_evaluaciones);
        }

        return $lista;
    }

    /**
     * Verifica si un empleado es Supervisor.
     * 
     * @param  Codigo Empleado
     * @return Evaluador
     */
    public static function cnVerificarsEvaluador($param)
    {
        // obtenemos los empelados supoer
         $evaluador_id = User::select('evaluador_empleados.evaluador_id')
            ->leftjoin('evaluador_empleados', 'evaluador_empleados.user_id', '=', 'users.id')
            ->where('evaluador_empleados.user_id', '=', $param)
            ->first();

        $evaluador = Evaluador::select('evaluadores.id', 'evaluadores.abreviatura', 'evaluadores.descripcion', 'evaluadores.ponderacion_id')
                            ->where('id', $evaluador_id->evaluador_id)->first();
        return $evaluador;
    }

    public static function cnGetPonderacionTipoIndicadores($evaluador)
    {
        return DB::select('call pa_ponderaciones_tipoPonderacion('.$evaluador.');');
    }

    public static function cnGetLimitesEscalas($evaluador)
    {
        return DB::select('call pa_ponderaciones_escalaPonderaciones('.$evaluador.');');
    }

    /*
     * Lista de empleados que se evaluados en la gerencia de evaluadores
    */
    public static function cnGetEmpleadosEvaluados($indicador_id, $evaluador_id)
    {
        return DB::select('call pa_evaluadores_empleadosEvaluados('.$indicador_id.', '.$evaluador_id.');');
    }

    /**
     * Obtener los indicadores asiganados a la gerencia buscada
     *
     * datos retorna: id indicador, nombre indicador, ponderacion indicador, id tipo indicador, nombre de tipo indicador
     *
     * @param $evaluador
     * @return mixed
     */
    public static function cnGetTotalIndicadores()
    {
        self::$evaluador = \Cache::get('evadores')->id;

        return   \DB::select('call pa_evaluadores_totalIndicadores(' . self::$evaluador . ');');
    }


    public static function cnListaDeIndicadorEficaciaPorEmpleado($indicador, $mes)
    {
        $lista = array();

        self::$evaluador = \Cache::get('evadores')->id;

        $empleados = \DB::select('call pa_evaluadores_empleadosEvaluados(' .$indicador.', '.self::$evaluador. ');');

        foreach ($empleados as $empleado){
            $objeto = new stdClass();

            // Agregamos los datos del empleado
            $objeto = self::agregarDatosEmpleados($objeto, $empleado);
            $eficacia = \DB::select('call pa_supervisores_EficaciaIndicador(' .$empleado->codigo.');');

//            dd($eficacia);

            // Agregamos los datos del empleado
            $objeto = self::agregarDatosEficacia($objeto, $eficacia, $mes, $empleado->codigo);

            array_push($lista, $objeto);
        }

        return $lista;
    }

    private static function agregarDatosEmpleados($objeto, $empleado)
    {
        // creamos el nuevo objeto de
        $objeto->codigo = $empleado->codigo;
        $objeto->nombres = $empleado->nombres .' '.$empleado->apellidos;

        return $objeto;
    }

    private static function agregarDatosEficacia($objeto, $datos, $mes, $codigo)
    {
        $lista = array();
        array_push($lista, $codigo);

        foreach ($datos as $dato)
        {
            if($dato->mes == $mes)
            {
                $eficacia = new stdClass();
                if (!isset($objeto->gestion)){
                    $objeto->gestion = $dato->gestion;
                    $objeto->mes     = $dato->mes;
                    $objeto->semanas = $dato->semanas;
                }

                $eficacia->mes = $dato->mes;
                $eficacia->semana = $dato->semana;
                $eficacia->actpro = $dato->actpro;
                $eficacia->actrea = $dato->actrea;
                $eficacia->efeser = $dato->efeser;

                array_push($lista, $eficacia);
            }

        }

        $objeto->eficacia = $lista;

        return $objeto;
    }

    /**
     *      * Devuelve la lista de Tipo de indicadores para un evaluador
     *
     */
    public static function getListaTiposIndicadores($evaluador)
    {
        return \DB::select('call pa_evaluador_tipoIndicador('.$evaluador.');');
    }

    /**
     *      * Devuelve la lista de indicadores para un evaluador
     *
     */
    public static function getListaIndicadores($evaluador)
    {
        return \DB::select('call pa_evaluador_indicador('.$evaluador.');');
    }


    public static function getEvaluadorWidget($evaluador, $usuario)
    {
        return Widget::where('evaluador_widget.evaluador_id', '=', $evaluador)
            ->where('evaluador_widget.user_id', '=', $usuario)
            ->select(
                'evaluador_widget.id',
                'evaluador_widget.tipo_id',
                'evaluador_widget.titulo',
                'evaluador_widget.isSemanal',
                'evaluador_widget.anio',
                'evaluador_widget.mesInicio',
                'evaluador_widget.mesBuscado',
                'evaluador_widget.tipo_id',
                'evaluador_widget.tipoIndicador_id',
                'evaluador_widget.indicador_id',
                'evaluador_widget.mesTarea',
                'evaluador_widget.semanaTarea'
            )
            ->get();
    }

    public static function deleteEvaluadorWidget($id)
    {
        Widget::destroy($id);

        return true;
    }


}
