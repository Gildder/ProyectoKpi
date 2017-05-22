<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use ProyectoKpi\Cms\Clases\TablaMes;
use ProyectoKpi\Cms\Clases\TablaSemana;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Cms\Clases\IndicadorReporte;
use ProyectoKpi\Models\Empleados\Empleado;

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
            ->select('empleados.codigo', 'empleados.nombres', 'empleados.apellidos', 'departamentos.nombre as departamento', 'users.name as usuario', 'users.email as correo', 'cargos.nombre as cargo', 'evaluadores.descripcion as gerencia')
            ->join('cargos', 'cargos.id', '=', 'evaluador_cargos.cargo_id')
            ->join('empleados', 'empleados.cargo_id', '=', 'evaluador_cargos.cargo_id')
            ->join('departamentos', 'departamentos.id', '=', 'empleados.departamento_id')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->join('_TablaMes', 'evaluadores.id', '=', 'evaluador_cargos.evaluador_id')
            ->join('evaluador_empleados', 'evaluador_empleados.evaluador_id', '=', 'evaluador_cargos.evaluador_id')
            ->where('empleados.codigo', '<>', $empleado_id)
            ->where('evaluador_empleados.evaluador_id', $evaluador_id)
            ->get();
    }


    /**
     * Retorna los datos de un Indicador de un Mes por Semana
     *
     * @param $evaluador
     * @param $anio
     * @param $mes
     * @param $indicador
     * @return mixed
     */
    public static function cnGetIndicadoresSemana($indicador, $evaluador, $anio, $mes)
    {
        return \DB::select('call pa_evaludados_procesosSemana(' . $evaluador . ', ' . $indicador . ', ' . $anio . ', ' . $mes . ');');
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
         $evaluador_id = Empleado::select('evaluador_empleados.evaluador_id')
            ->join('evaluador_empleados', 'evaluador_empleados.empleado_id', '=', 'empleados.codigo')
            ->where('evaluador_empleados.empleado_id', '=', $param)
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
     * @param $evaluador
     * @return mixed
     */
    public static function cnGetTotalIndicadores()
    {
        self::$evaluador = \Cache::get('evadores')->id;

         return   \DB::select('call pa_evaluadores_totalIndicadores(' . self::$evaluador . ');');
    }



    public static function getIndicadoresPromediosMes($evaluador_id)
    {
        $lista = array();
        $cumplimiento = 0;
        $indicadores = self::cnGetTotalIndicadores($evaluador_id);

        foreach ($indicadores as $item) {
            $indicador = new TablaMes($item->id, $item->nombre, $item->ponderacion, $evaluador_id);

            // Calculamos porcentaje de cumplimiento
            $cumplimiento = $cumplimiento + (($indicador->getPonderacion() * $indicador->getPromedio())/100);
            array_push($lista, $indicador) ;
        }

        array_push($lista, ['cumplimiento'=> $cumplimiento]);

        return $lista;
    }

    /**
     * @param $item
     * @param $ponderacion
     * @return IndicadorReporte
     */
    private static function getIndicadorDeMesPorSemana($item, $ponderacion)
    {
        // indicador el nuevo indicador
        $indicador = new IndicadorReporte();
        $indicador->id = $item->id;
        $indicador->nombre = $item->nombre;
        $indicador->ponderacion = $item->ponderacion;
        $indicador->promedio = $ponderacion[0]->promedio;

        $indicador->semana1 = $ponderacion[0]->semana_1;
        $indicador->semana2 = $ponderacion[0]->semana_2;
        $indicador->semana3 = $ponderacion[0]->semana_3;
        $indicador->semana4 = $ponderacion[0]->semana_4;
        switch ($ponderacion[0]->cantidadSemana) {
            case 5:
                $indicador->semana5 = $ponderacion[0]->semana_5;
                break;
            case 6:
                $indicador->semana5 = $ponderacion[0]->semana_5;
                $indicador->semana6 = $ponderacion[0]->semana_6;
                break;
        }
        return $indicador;
    }
}
