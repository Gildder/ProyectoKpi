<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Cms\Repositories\PonderacionRepository;
use ProyectoKpi\Models\Empleados\Evaluador;
use ProyectoKpi\Models\Evaluadores\Ponderacion;
use ProyectoKpi\Http\Requests\Evaluadores\PonderacionFormRequest;


class PonderacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ponderaciones = Ponderacion::all();
        return view('evaluadores/ponderacion/index', ['ponderaciones'=> $ponderaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluadores/ponderacion/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PonderacionFormRequest $request)
    {
        $ponderacion = new Ponderacion;
        $ponderacion->nombre = trim(\Request::input('nombre'));
        $ponderacion->descripcion = trim(\Request::input('descripcion'));
        $ponderacion->save();

        return redirect('evaluadores/ponderacion')
                ->with('message', 'La ponderacion "'.$ponderacion->nombre.'" se guardo correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ponderacion = Ponderacion::FindOrFail($id);

        // tiposDisponibles,  tiposAgregados, tipoponderacion = ponderacion restante del 100
        $indicadoresAgregados = DB::select('call pa_ponderaciones_indicadoresAgregados('.$id.');');
        $indicadoresDisponibles = DB::select('call pa_ponderaciones_indicadoresDisponibles('.$id.');');
        // $indicadorponderacion = DB::select('call pa_ponderaciones_ponderacionIndicador('.$id.');');

        // indicadoresDisponibles,  indicadoresAgregados, indicadorponderacion = ponderacion restante del 100
        $tiposAgregados = DB::select('call pa_ponderaciones_tiposAgregados('.$id.');');
        $tiposDisponibles = DB::select('call pa_ponderaciones_tiposDisponibles('.$id.');');
        // $tipoponderacion = DB::select('call pa_ponderaciones_ponderacionTipo('.$id.');');

        // Escalas Disponibles y escalas Agregadas 
        $escalasAgregados = DB::select('call pa_ponderaciones_escalasAgregados('.$id.');');
        $escalasDisponibles = DB::select('call pa_ponderaciones_escalasDisponibles('.$id.');');

        // var_dump($tipoponderacion[0]->ponderacion);

                
        return view('evaluadores/ponderacion/show',['ponderacion'=>$ponderacion,'indicadoresAgregados'=>$indicadoresAgregados,'indicadoresDisponibles'=>$indicadoresDisponibles,'tiposAgregados'=>$tiposAgregados, 'tiposDisponibles'=>$tiposDisponibles,'escalasAgregados'=>$escalasAgregados, 'escalasDisponibles'=>$escalasDisponibles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ponderacion = Ponderacion::findOrFail($id);
        
        return view('evaluadores/ponderacion/edit',['ponderacion'=>$ponderacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PonderacionFormRequest $request, $id)
    {
        $ponderacion = Ponderacion::findOrFail($id);
        $ponderacion->nombe = trim(\Request::input('nombe'));
        $ponderacion->descripcion = trim(\Request::input('descripcion'));
        $ponderacion->save();

        return redirect('evaluadores/ponderacion')->with('message',  'La Ponderacion Nro. '.$id.' - '.$Request->nombre.' se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ponderacion::destroy($id);

        return redirect('evaluadores/ponderacion')->with('message',  'La Ponderacion Nro.- '.$id.'  se elimino correctamente.');
    }



    public function agregarindicador(Request $request, $ponderacion_id, $indicador_id)
    {
        $ponderacion = \Request::input('ponderacion');

        DB::table('indicador_ponderacion')->insert(
            array('ponderacion' => $ponderacion,'ponderacion_id' => $ponderacion_id, 'indicador_id' => $indicador_id)
        );
        return redirect()->back()->with('message', 'Se agrego el indicador Nro '.$emp_id.' correctamente.');
    }

    public function quitarindicador( $ponderacion_id, $indicador_id)
    {
        DB::table('indicador_ponderacion')->where('ponderacion_id', $ponderacion_id)->where('indicador_id', $indicador_id)->delete();

        return redirect()->back()->with('message', 'Se quito el indicador Nro '.$indicador_id.' correctamente.');
        
    }

    public function agregartipo(Request $request, $ponderacion_id, $tipoIndicador_id)
    {
        $ponderacion = \Request::input('ponderacion');
        
        DB::table('tipo_ponderaciones')->insert(
             array('ponderacion' => $ponderacion,'ponderacion_id' => $ponderacion_id, 'tipoIndicador_id' => $tipoIndicador_id)
        );

        return redirect()->back()->with('message', 'Se agrego el tipo de indicador Nro '.$tipoIndicador_id.' correctamente.');
    }

    public function quitartipo($ponderacion_id, $tipoIndicador_id)
    {
        DB::table('tipo_ponderaciones')->where('ponderacion_id', $ponderacion_id)->where('tipoIndicador_id', $tipoIndicador_id)->delete();

        return redirect()->back()->with('message', 'Se quito el tipo de indicador Nro '.$tipoIndicador_id.' correctamente.');
    }

    public function agregarescala(Request $request, $ponderacion_id, $escala_id)
    {
        $minimo = \Request::input('minimo');
        $maximo = \Request::input('maximo');
        
        DB::table('escala_ponderacion')->insert(
             array('minimo' => $minimo,'maximo' => $maximo,'ponderacion_id' => $ponderacion_id, 'escala_id' => $escala_id)
        );

        return redirect()->back()->with('message', 'Se agrego la escala de cumplimiento Nro '.$escala_id.' correctamente.');
    }

    public function quitarescala($ponderacion_id, $escala_id)
    {
        DB::table('escala_ponderacion')->where('ponderacion_id', $ponderacion_id)->where('escala_id', $escala_id)->delete();

        return redirect()->back()->with('message', 'Se quito la escala de cumplimiento Nro '.$escala_id.' correctamente.');
    }

}
