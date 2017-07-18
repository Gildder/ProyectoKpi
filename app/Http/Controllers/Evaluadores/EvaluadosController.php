<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Httpful\Response;
use Illuminate\Http\Request;
use ProyectoKpi\Cms\Clases\Conexion_LDAP;
use ProyectoKpi\Cms\Clases\FiltroTabla;
use ProyectoKpi\Cms\Clases\UsuarioActivo;
use ProyectoKpi\Cms\Negocios\nDashboard;
use ProyectoKpi\Cms\Negocios\nTablaMes;
use ProyectoKpi\Cms\Repositories\ConfiguracionRepositorio;
use ProyectoKpi\Http\Controllers\Controller;


use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Cms\Repositories\IndicadorRepository;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Evaluadores\Widget;

class EvaluadosController extends Controller
{
    private $dashboard;
    private $filtro;

    public function __contruct()
    {
        $this->middleware('auth');
        $this->filtro = new FiltroTabla();
    }

    /**
     * Display a listing of the resource.
     *
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
//        $ldap = new Conexion_LDAP();
////        $ldap->conectar();
//        $resulta = $ldap->mailboxpowerloginrd('gguerreros', 'multicenter2');
//
//        dd($resulta);
//        dd(ConfiguracionRepositorio::getGenerarSemanasAnuales(2017));
//        $semsns = ConfiguracionRepositorio::getGenerarSemanasAnuales(2017);



        $this->dashboard = new nDashboard();

//        dd(json_encode($this->dashboard->obtenerEvaluadorWidget()));

        $this->cachearFiltro(new FiltroTabla());

        return view('evaluadores/evaluados/dashboard/index', [
            'tipos'  => $this->dashboard->obtenerPondTiposIndicadores(),
            'escalas'=> $this->dashboard->obtenerPondEscalas(),
            'widgets'=> $this->dashboard->obtenerListaItemWidget(),
            'evaluadorWidgets' => $this->dashboard->obtenerEvaluadorWidget(),
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

    /**
     * Devuelve los datos del Widget, segun el tipo de widget Solicitado,
     *
     * @return mixed: retorna los datos de la tabla y de la grafica
     */
    public function obtenerVista($tipoWidget)
    {



        $this->dashboard = new nDashboard();

        $datos = $this->dashboard->obtenerDatosWidget($tipoWidget);

        return array(
            'tabla' => array_pop($datos),
            'chart' => array_pop($datos),
        );
    }

    /**
     * Obtenemos la tabla total de los indicadores de Gia. Evaluadora
     *
     * @param $tipo
     * @return array
     */
    public function obtenerTablaWidget($widget)
    {
        // objeto de negocio Dashboard
        $this->dashboard = new nDashboard();

        $datos = $this->dashboard->obtenerDatosTabla($widget);

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
    public function obtenerChartWidget($widget)
    {
        $this->dashboard = new nDashboard();

        $datos = $this->dashboard->obtenerDatosChart($widget);

        $categorias = array_pop($datos);
        $indicadores = array_pop($datos);

        return [
            'indicadores' => json_encode($indicadores),
            'categorias'=> json_encode($categorias)
        ];
    }


    //*************************************************************************

    /**
     * Obtenermos las datos para mostra en la tabl de widget
     *
     */
    public function obtenerDatosTablaWidget(Request $request)
    {
        $widget = new Widget();
        $widget->id = $request->id;
        $widget->evaluador_id = \Cache::get('evadores')->id;
        $widget->user_id = \Usuario::get('id');
        $widget->tipo_id = $request->tipo_id;
        $widget->titulo = $request->titulo;
        $widget->isSemanal = $request->isSemanal;
        $widget->tipoIndicador_id = $request->tipoIndicador_id;
        $widget->indicador_id = $request->indicador_id;
        $widget->anio = $request->anio;
        $widget->mesInicio = $request->mesInicio;
        $widget->mesBuscado = $request->mesBuscado;
        $widget->mesTarea = $request->mesTarea;
        $widget->semanaTarea = $request->semanaTarea;

//        return $widget;

        $this->dashboard = new nDashboard();

        return $this->dashboard->obtenerDatosTabla($widget);



    }

    /**
     * Obtenermos las datos para mostra en la tabl de widget
     *
     */
    public function obtenerDatosChartWidget(Request $request)
    {
        $widget = new Widget();
        $widget->id = $request->id;
        $widget->evaluador_id = \Cache::get('evadores')->id;
        $widget->user_id = \Usuario::get('id');
        $widget->tipo_id = $request->tipo_id;
        $widget->titulo = $request->titulo;
        $widget->isSemanal = $request->isSemanal;
        $widget->tipoIndicador_id = $request->tipoIndicador_id;
        $widget->indicador_id = $request->indicador_id;
        $widget->anio = $request->anio;
        $widget->mesInicio = $request->mesInicio;
        $widget->mesBuscado = $request->mesBuscado;
        $widget->mesTarea = $request->mesTarea;
        $widget->semanaTarea = $request->semanaTarea;

        $this->dashboard = new nDashboard();

        return $this->dashboard->obtenerDatosChart($widget);
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


    /**
     * Devuelve la lista de indicadores para esta gerencia
     *
     */
    public function obtenerTiposIndicadores()
    {
        $this->dashboard = new nDashboard();

        $tiposIndicadores = $this->dashboard->obtenerTiposIndicadores();
        $indicadores = $this->dashboard->obtenerIndicadores();

        return Response()->json([
            'tipos'=> $tiposIndicadores,
            'indicadores'=>$indicadores
        ]);

    }

    /**
     * Obtener el ultimes de los inticadores
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerMesActual()
    {
        $mes =  date("n") -1;
        return Response()->json($mes);
    }

    /**
     * Obtener cantidad de semanas para un mes
     *
     * @return Request
     *
     */
    public function obtenerCantidadSemanasMes(Request $request)
    {
        $mes = $request->mesTarea;


        $this->dashboard = new nDashboard();

        $semanas = $this->dashboard->obtenerCantidadSemana($mes);

        return Response()->json($semanas[0]->semanas);
    }

    public function obtenerFechasSemanas($request)
    {
        $semana = $request;
        $this->dashboard = new nDashboard();

        // incompleto en el repositrio
        $semanas = $this->dashboard->obtenerfechasSemana($semana);

        return Response()->json($semanas[0]);
    }

    public function guardarWidget(Request $request)
    {
        \DB::table('evaluador_widget')->truncate();


        $widget = Widget::create([
            'evaluador_id' =>  \Cache::get('evadores')->id,
            'user_id' => \Usuario::get('id'),
            'tipo_id' => $request->tipo_id,
            'titulo' => $request->titulo,
            'isSemanal' => $request->isSemanal,
            'anio' => date("Y"),
            'tipoIndicador_id' => $request->tipoIndicador_id,
            'indicador_id' => $request->indicador_id,
            'mesInicio' => $request->mesInicio,
            'mesBuscado' => $request->mesBuscado,
            'mesTarea' => $request->mesTarea,
            'semanaTarea' => $request->semanaTarea,
        ]);


        return Response()->json($widget);
    }

    public function obtenerEvaluadorWidget()
    {
        $this->dashboard = new nDashboard();

        $widgets = $this->dashboard->obtenerEvaluadorWidget();

        return Response()->json($widgets);
    }

    public function eliminarEvaluadorWidget(Request $request)
    {
        $this->dashboard = new nDashboard();

        $widgets = $this->dashboard->eliminarEvaluadorWidget($request->id);

        return Response()->json($widgets);
    }

    public function actualizarWidget(Request $request)
    {
        $widget = Widget::findOrFail($request->id);
        $widget->tipo_id = $request->tipo_id;
        $widget->titulo = $request->titulo;
        $widget->isSemanal = $request->isSemanal;
        $widget->tipoIndicador_id = $request->tipoIndicador_id;
        $widget->indicador_id = $request->indicador_id;
        $widget->anio = $request->anio;
        $widget->mesInicio = $request->mesInicio;
        $widget->mesBuscado = $request->mesBuscado;
        $widget->mesTarea = $request->mesTarea;
        $widget->semanaTarea = $request->semanaTarea;

        $widget->save();



        return Widget::findOrFail($request->id);
    }

}
