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
        $evaluados = EvaluadoresRepository::cnGetEvaluados(\Cache::get('evadores')->id, \Usuario::get('id'));
        return view('evaluadores/evaluados/index', ['evaluados'=> $evaluados]);
    }

    public function show($id)
    {
        return 'Lista de Evaluados';
    }

    /**
     * Vista principal de los evaluadores para observar los reportes de los empleados
    */
    public function dashboard()
    {
        $this->dashboard = new nDashboard();

        // Ca
        $this->cachearFiltro(new FiltroTabla());

        return view('evaluadores/evaluados/dashboard/index', [
            'tipos'  => $this->dashboard->obtenerPondTiposIndicadores(),
            'escalas'=> $this->dashboard->obtenerPondEscalas(),
            'widgets'=> $this->dashboard->obtenerListaItemWidget()
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
            'filtroVista' => \FiltroTabla::getTipo()
        ];
    }
    public function obtenerVista()
    {
        return \FiltroTabla::toString();
    }

    /**
     * Obtenemos la tabla total de los indicadores de Gia. Evaluadora
     *
     * @param $tipo
     * @return array
     */
    public function obtenerTablaTotal($tipo, $mesBuscado)
    {
        // objeto de negocio Dashboard
        $this->dashboard = new nDashboard();

        if($tipo == 0){//obtener los datos por semanas de un mes particular
            \FiltroTabla::setMesBuscado($mesBuscado);
            $datos = $this->dashboard->obtenerListaTablaSemana();
        }else{ // obtener los datos desde un mes inicial
            \FiltroTabla::setPrimerMes($mesBuscado);
            $datos = $this->dashboard->obtenerListaTablaMes();
        }

        $cumplimiento = array_pop($datos);
        $descripciones = array_pop($datos);

        return [
            'indicadores' => json_encode($datos),
            'cumplimiento'=> $cumplimiento,
            'descripciones'=> json_encode($descripciones)
        ];
    }

    /**
     * Obtenemos la tabla total de los indicadores de Gia. Evaluadora
     *
     * @param $tipo
     * @return array
     */
    public function obtenerChartTotal($tipo, $mesBuscado)
    {
        $this->dashboard = new nDashboard();

        if($tipo == 0){
            \FiltroTabla::setMesBuscado($mesBuscado);
            $datos = $this->dashboard->obtenerListaChartSemana();
        }else{
            \FiltroTabla::setPrimerMes($mesBuscado);
            $datos = $this->dashboard->obtenerListaChartMes();
        }

        $categorias = array_pop($datos);
        $indicadores = array_pop($datos);

        return [
            'indicadores' => json_encode($indicadores),
            'categorias'=> json_encode($categorias)
        ];
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

    public function actualizarFiltroTabla($filtro)
    {
        \FiltroTabla::setTipo($filtro->tipo);
        \FiltroTabla::setAnio($filtro->anio);
        \FiltroTabla::setMesBuscado($filtro->mesBuscado);
        \FiltroTabla::setPrimerMes($filtro->primerMes);

        return [
            'filtroVista' => \FiltroTabla::toString()
        ];
    }

    public function cachearFiltro($filtro)
    {
        \Cache::forget('filtroTabla');
        \Cache::forever('filtroTabla', $filtro);
    }


}
