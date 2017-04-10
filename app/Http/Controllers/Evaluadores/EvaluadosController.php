<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Cms\Repositories\EvaluadoresRepository;
use ProyectoKpi\Models\Evaluadores\Evaluador;
use ProyectoKpi\Models\Empleados\Empleado;


class EvaluadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtenemos el Id del Evaluador
        $id = json_decode(\Cache::get('evadores'));

        $user = Auth::user();

        $evaluados = EvaluadoresRepository::getEvaluados($id->evaluador_id, $user->empleado->codigo );

        return view('evaluadores/evaluados/index', ['evaluados'=> $evaluados]);
    }

    public function dashboard()
    {
        // Obtenermos el Id del evaluador
        $id = json_decode(\Cache::get('evadores'));
        $evaluador = Evaluador::findOrFail($id->evaluador_id);

        $tipos = DB::select('call pa_ponderaciones_tipoPonderacion('.$evaluador->ponderacion_id.');');
        $escalas = DB::select('call pa_ponderaciones_escalaPonderaciones('.$id->evaluador_id.');');
        $indicadores = DB::select('call evaluadores_totalIndicadores('.$id->evaluador_id.');');

// dd($tipos, $escalas, $indicadores);

        
        return view('evaluadores/evaluados/dashboard/index', ['tipos'=> $tipos, 'evaluador'=> $evaluador, 'escalas'=> $escalas, 'indicadores'=> $indicadores]);
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

        dd(json_encode($empleado));
        

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
}
