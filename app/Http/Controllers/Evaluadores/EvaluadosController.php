<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;
use ProyectoKpi\Cms\Clases\FiltroTabla;
use ProyectoKpi\Cms\Negocios\nDashboard;
use ProyectoKpi\Cms\Negocios\nTablaMes;
use ProyectoKpi\Http\Controllers\Controller;


use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Indicadores\Indicador;

class EvaluadosController extends Controller
{
    private $dashboard;
    private $tiposIndicadores;
    private $ponderacionEscala;
    private $indicadoresSemana;
    private $indicadoresMes;
    private $filtro;

    public function __contruct()
    {
        $this->middleware('auth');
        $this->dashboard = new nDashboard();
        $this->filtro = new FiltroTabla();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->tablaMes = new nTablaMes();

        // Obtenemos el Id del Evaluador
        $id = \Cache::get('evadores');
        //dd(json_encode($id));
        $evaluados = EvaluadoresRepository::cnGetEvaluados($id->evaluador_id, \Usuario::get('codigo'));
        return view('evaluadores/evaluados/index', ['evaluados'=> $evaluados]);
    }

    /**
     * Vista principal de los evaluadores para observar los reportes de los empleados
    */
    public function dashboard()
    {

        $this->dashboard = new nDashboard();
        $this->tiposIndicadores   = $this->dashboard->obtenerPondTiposIndicadores();
        $this->ponderacionEscala  = $this->dashboard->obtenerPondEscalas();

        $this->obtenerTablaSemana();
        $this->obtenerTablaMes();

//        dd($this->indicadoresMes,  \Cache::get('_TablaMes') );

        return view('evaluadores/evaluados/dashboard/index', [
            'tipos'  => $this->tiposIndicadores,
            'escalas'=> $this->ponderacionEscala
        ]);
    }

    public function opcionVista($id)
    {
        \FiltroTabla::setTipo($id);
        if($id == 0){
            $this->obtenerTablaSemana();
        }else{
            $this->obtenerTablaMes();
        }

        return [
            'tipoVista' => \FiltroTabla::getTipo()
        ];
    }

    public function obtenerVista()
    {
        return \FiltroTabla::getTipo();
    }

    public function filtroMes($cantidad)
    {
        // verificamos el paratro de la busqueda enviadas por el formulario
        if ($cantidad != 0) {
            $mes = \FiltroTabla::restarAlUltimoMes($cantidad);
        } else { // si es iguala cero el primer mes debe ser enero = 1
            $mes = 1;
        }

        \FiltroTabla::setPrimerMes($mes);
        $this->obtenerTablaMes();

        return ['primerMes'=>\FiltroTabla::getPrimerMes()];
    }

    public function filtroSemana(Request $request)
    {
        $vista = \Request::input('selectVer');
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
        $this->dashboard = new nDashboard();

        $this->indicadoresSemana    = $this->dashboard->obtenerListaTablaSemana();

        $cumplimiento = array_pop($this->indicadoresSemana);

        \Cache::forget('tablaSemana');
        \Cache::forever('tablaSemana', $this->indicadoresSemana);

        \Cache::forget('cumplimientoSemana');
        \Cache::forever('cumplimientoSemana', $cumplimiento);

    }

    /**
     * Obtenemos y Salvamos la tabla de Meses
    */
    private function obtenerTablaMes()
    {
        $this->dashboard = new nDashboard();
        $this->indicadoresMes       = $this->dashboard->obtenerListaTablaMes();

        $cumplimiento = array_pop($this->indicadoresMes);

        \Cache::forget('TablaMes');
        \Cache::forever('TablaMes', $this->indicadoresMes);

        \Cache::forget('cumplimientoMes');
        \Cache::forever('cumplimientoMes', $cumplimiento);
    }


    public function colocarTipo($tipo, $mes, $opcion)
    {
        \FiltroTabla::setTipo($tipo);

        if($opcion == 0){
            \FiltroTabla::setMesBuscado($mes);
        }else{
            \FiltroTabla::setPrimerMes($mes);
        }
    }




}
