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
use ProyectoKpi\Models\Empleados\Empleado;
use ProyectoKpi\Models\Indicadores\Indicador;


class EvaluadosController extends Controller
{
    private $indicador;
    private $filtroEvaluador;
    public function __contruct()
    {
        $this->filtroEvaluador = new FiltroEvaluadores();
        $this->middleware('auth', 'evaluadores', 'estandard');
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
        // obtenemo s de cache los parametro de los filtro de tabla
       $filtro = \Cache::get('filtroEvaluador');
       if(empty($filtro))
       {
           $filtro = array( 'ver' => 0, 'desde'=> 0);
           \Cache::forever('filtroEvaluador', json_encode($filtro) );
       }

        // convertir en dinamico los prametros de las fechas
        $anio = 2017;
        $mes = 5;

        // Obtenemos el Id del evaluador
        $id = json_decode(\Cache::get('evadores'));
        $evaluador = Evaluador::findOrFail($id->evaluador_id);

        $tipos = EvaluadoresRepository::cnGetPonderacionTipoIndicadores($evaluador->id);
        $escalas = EvaluadoresRepository::cnGetLimitesEscalas($evaluador->id);
        // Obtnemos los indicadores de la gerencia evaluadora
        $indicadores = EvaluadoresRepository::getIndicadoresPromediosSemanales($evaluador->id, $anio, $mes);

        // Semana Actual
        $semanaHoy = array_pop($indicadores);
        $semanaCant = array_pop($indicadores);
        $cumplimiento = array_pop($indicadores);

        return view('evaluadores/evaluados/dashboard/index', [
            'tipos'=> $tipos, 
            'evaluador'=> $evaluador, 
            'escalas'=> $escalas, 
            'indicadores'=> $indicadores, 
            'semanaCant'=> $semanaCant,
            'semanaHoy'=> $semanaHoy,
            'cumplimiento'=> $cumplimiento,
            'mes'=> CalcularSemana::getNombreMes($mes)
        ]);
    }

    public function tablaTipoIndicadores()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    
     /* Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::where('codigo', $id)->get();

        return view('evaluadores/evaluados/show',  ['empleado'=> $empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
