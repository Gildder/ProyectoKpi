<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ProyectoKpi\Cms\Clases\FiltroEvaluadores;
use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;


use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Cms\Clases\CalcularSemana;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Indicadores\Indicador;

use ProyectoKpi\Cms\Clases\FiltroTabla;

class EvaluadosController extends Controller
{
    private $evaluador_id;

    public function __contruct()
    {
        $evaluador_id =
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtenemos el Id del Evaluador
        $id = json_decode(\Cache::get('evadores'));
        $evaluados = EvaluadoresRepository::cnGetEvaluados($id->evaluador_id, \Usuario::get('codigo') );

        return view('evaluadores/evaluados/index', ['evaluados'=> $evaluados]);
    }

    /**
     * Vista principal de los evaluadores para observar los reportes de los empleados
    */
    public function dashboard()
    {
        /* obtenemos las tabla de semanas y meses */
        $this->obtenerTablaSemana();
        $this->obtenerTablaMes();

//        dd(\Cache::get('tablaSemana'),\Cache::get('cumplimientoSemana'),\Cache::get('tablaMes'),\Cache::get('cantSemana'));

        $tipos = EvaluadoresRepository::cnGetPonderacionTipoIndicadores(\Cache::get('evadores')->id);
        $escalas = EvaluadoresRepository::cnGetLimitesEscalas(\Cache::get('evadores')->id);

        return view('evaluadores/evaluados/dashboard/index', [
            'tipos'=> $tipos,
            'escalas'=> $escalas
        ]);
    }

    public function opcionVista($id, Request $request)
    {
        \FiltroTabla::setTipo($id);

        $indicadores = EvaluadoresRepository::getIndicadoresPromedios(\Cache::get('evadores')->id);
        $contadorTiempo = array_pop($indicadores);
        $cumplimiento = array_pop($indicadores);

        \Cache::forget('tablaIndicadores');
        \Cache::forever('tablaIndicadores', $indicadores);

        if($request->ajax()){
            $view = View::make('evaluadores.evaluados.dashboard');

            return response()->json([
                'contadorTiempo' => $contadorTiempo,
                'cumplimiento'   => $view->renderSections()['']
            ]);
        }

        return redirect()->back();
    }

    public function filtroMes(Request $request)
    {
        $cantidad = \Request::input('selectOpcion');

        // verificamos el paratro de la busqueda enviadas por el formulario
        if($cantidad != 0){
            $mes = \FiltroTabla::restarAlUltimoMes($cantidad);
        }else{ // si es iguala cero el primer mes debe ser enero = 1
            $mes = 1;
        }

        \FiltroTabla::setPrimerMes($mes);

        return $this->dashboard();
    }

    public function filtroSemana(Request $request)
    {
        $vista = \Request::input('selectVer');

        dd($vista);
    }

    /**
     * Obtener todos los empleados que se evaluaron .
     *
     * @param  int  $indicador_id
     * @param  int  $evaluador_id
     * @return \Illuminate\Http\Response
     */
    public function empleadosEvaluados($indicador_id, $evaluador_id)
    {
       $empleados = EvaluadoresRepository::cnGetEmpleadosEvaluados($indicador_id, $evaluador_id);
       $indicador = Indicador::findOrFail($indicador_id);
       $evaluador = Evaluador::findOrFail($evaluador_id);

       return view('evaluadores/evaluados/empleados/index', ['empleados'=>$empleados, 'indicador'=>$indicador, 'evaluador'=>$evaluador]);
    }

    public function showIndicadorEmpleado($empleado_id, $indicador_id)
    {
        $listaTablas = IndicadorRepository::getTablaIndicador($empleado_id, $indicador_id);  
        $listaGraficas = IndicadorRepository::getGraficoIndicador($empleado_id, $indicador_id);  
    }

    /**
     * Obtenemos y Salvamos la tabla de Semanas
     */
    private function obtenerTablaSemana()
    {
        $semana = EvaluadoresRepository::getIndicadoresPromediosSemana(\Cache::get('evadores')->id);
        $cumplimiento = array_pop($semana);
        $semanas = array_pop($semana);

        \Cache::forget('tablaSemana');
        \Cache::forever('tablaSemana', $semana);

        \Cache::forget('cumplimientoSemana');
        \Cache::forever('cumplimientoSemana', $cumplimiento);

        \Cache::forget('cantSemana');
        \Cache::forever('cantSemana', $semanas);
    }

    /**
     * Obtenemos y Salvamos la tabla de Meses
    */
    private function obtenerTablaMes()
    {
        $mes = EvaluadoresRepository::getIndicadoresPromediosMes(\Cache::get('evadores')->id);
        $cumplimiento = array_pop($mes);

        \Cache::forget('tablaMes');
        \Cache::forever('tablaMes', $mes);

        \Cache::forget('cumplimientoMes');
        \Cache::forever('cumplimientoMes', $cumplimiento);
    }
}
