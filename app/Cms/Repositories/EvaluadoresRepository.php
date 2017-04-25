<?php 
namespace ProyectoKpi\Cms\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

use ProyectoKpi\Models\Tareas\Tarea;
use ProyectoKpi\Cms\Clases\IndicadorEvaluados;
use ProyectoKpi\Models\Empleados\Empleado;


class EvaluadoresRepository
{

    /*contructores */
    public function __construct()
    {
       
    }

    public static function getEvaluados($evaluador_id, $empleado_id)
    {
 
        $evaluados = DB::table('evaluador_cargos')
            ->select('empleados.codigo', 'empleados.nombres', 'empleados.apellidos', 'departamentos.nombre as departamento', 'users.name as usuario', 'users.email as correo', 'cargos.nombre as cargo', 'evaluadores.descripcion as gerencia')
            ->join('cargos', 'cargos.id', '=', 'evaluador_cargos.cargo_id')
            ->join('empleados', 'empleados.cargo_id', '=', 'evaluador_cargos.cargo_id')
            ->join('departamentos', 'departamentos.id', '=', 'empleados.departamento_id')
            ->join('users', 'users.id', '=', 'empleados.user_id')
            ->join('evaluadores', 'evaluadores.id', '=', 'evaluador_cargos.evaluador_id')
            ->join('evaluador_empleados', 'evaluador_empleados.evaluador_id', '=', 'evaluador_cargos.evaluador_id')
            ->where('empleados.codigo', '<>', $empleado_id)
            ->where('evaluador_empleados.evaluador_id',  $evaluador_id)
            ->get();

        return $evaluados;
    }

    /**
     * Verifica si un empleado es Supervisor.
     * 
     * @param  Codigo Empleado
     * @return boolean
     */
    public static function verificarsEvaluador($param)
    {
        // obtenemos los empelados supoer
        $result = Empleado::select('evaluador_empleados.evaluador_id')
            ->join('evaluador_empleados','evaluador_empleados.empleado_id','=','empleados.codigo')
            ->where('evaluador_empleados.empleado_id', '=', $param)
            ->first();

        return $result;

    }

    public static function getIndicadoresPromediosSemanales($evaluador, $anio, $mes)
    {
        $lista = array();
        $isCantidad = False;
        $cumplimiento = 0;
        $SemanaCant = 0;    // cantidad de semanas
        $semanaAct = 0; // semana Actual

        $indicadores = DB::select('call pa_evaluadores_totalIndicadores('.$evaluador.');');

        foreach ($indicadores as $item) {
            // obtenemos los promedios de los indicadores
            $pon = DB::select('call pa_evaludados_procesosSemana('.$evaluador.', '.$item->id.', '.$anio.', '.$mes.');');

            
            // indicador el nuevo indicador
            $indicador = new IndicadorEvaluados();
            $indicador->id      = $item->id;
            $indicador->nombre  = $item->nombre;
            $indicador->ponderacion = $item->ponderacion;
            $indicador->semana1 = $pon[0]->semana_1;
            $indicador->semana2 = $pon[0]->semana_2;
            $indicador->semana3 = $pon[0]->semana_3;
            $indicador->semana4 = $pon[0]->semana_4;
            $indicador->promedio = $pon[0]->promedio;

            // guardamos las semanas
            $SemanaCant = $pon[0]->cantidadSemana;
            $semanaAct = $pon[0]->semanaActual;

            // Calculamos el promedio total
            $cumplimiento = $cumplimiento + (($indicador->ponderacion * $indicador->promedio)/100);

            switch ($pon[0]->cantidadSemana) {
                case 5:
                    $indicador->semana5 = $pon[0]->semana_5;
                    break;
                case 6:
                    $indicador->semana6 = $pon[0]->semana_6;
                    break;
            }

            array_push($lista, $indicador);
        }

        array_push($lista, $cumplimiento);
        array_push($lista, $SemanaCant);
        array_push($lista, $semanaAct);

        return $lista;
    }

    public static function getPonderacionTipoIndicadores($evaluador)
    {
        return DB::select('call pa_ponderaciones_tipoPonderacion('.$evaluador.');');
    }

    public static function getLimitesEscalas($evaluador)
    {
        return DB::select('call pa_ponderaciones_escalaPonderaciones('.$evaluador.');');
    }
}