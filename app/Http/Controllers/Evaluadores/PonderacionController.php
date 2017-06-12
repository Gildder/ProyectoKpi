<?php

namespace ProyectoKpi\Http\Controllers\Evaluadores;

use Illuminate\Http\Request;

use ProyectoKpi\Http\Requests;
use ProyectoKpi\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use ProyectoKpi\Models\Empleados\Evaluador;
use ProyectoKpi\Models\Evaluadores\Escala;
use ProyectoKpi\Models\Evaluadores\Ponderacion;
use ProyectoKpi\Models\Indicadores\Indicador;
use ProyectoKpi\Models\Indicadores\TipoIndicador;
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

        $indicadoresAgregados = DB::select('call pa_ponderaciones_indicadoresAgregados('.$id.');');
        $indicadoresDisponibles = DB::select('call pa_ponderaciones_indicadoresDisponibles('.$id.');');

        // dd(json_encode($indicadoresDisponibles)); 

        $tiposAgregados = DB::select('call pa_ponderaciones_tiposAgregados('.$id.');');
        $tiposDisponibles = DB::select('call pa_ponderaciones_tiposDisponibles('.$id.');');

        $escalasAgregados = DB::select('call pa_ponderaciones_escalasAgregados('.$id.');');
        $escalasDisponibles = DB::select('call pa_ponderaciones_escalasDisponibles('.$id.');');

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

        return redirect('evaluadores/ponderacion')->with('message',  'La Ponderacion '.$request->nombre.' se actualizo correctamente.');
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
        $indicador = Indicador::FindOrFail($indicador_id);

        // dd($ponderacion, $indicador_id, $ponderacion_id);

        DB::table('indicador_ponderacion')->insert(
            array('ponderacion' => $ponderacion,'indicador_id' => $indicador_id,'ponderacion_id' => $ponderacion_id)
        );


        return redirect()->back()->with('message', 'Se agrego el indicador "'.$indicador->nombre.'" correctamente.');
    }

    public function quitarindicador( $indicador_id,  $ponderacion_id)
    {
        $indicador = Indicador::FindOrFail($indicador_id);

        DB::table('indicador_ponderacion')->where('ponderacion_id', $ponderacion_id)->where('indicador_id', $indicador_id)->delete();

        return redirect()->back()->with('message', 'Se quito el indicador  "'.$indicador->nombre.'" correctamente.');
        
    }

    public function agregartipo(Request $request, $ponderacion_id, $tipoIndicador_id)
    {
        $ponderacion = \Request::input('ponderacion');
        $tipo = TipoIndicador::FindOrFail($tipoIndicador_id);
        
        DB::table('tipo_ponderaciones')->insert(
             array('ponderacion' => $ponderacion,'ponderacion_id' => $ponderacion_id, 'tipoIndicador_id' => $tipoIndicador_id)
        );

        return redirect()->back()->with('message', 'Se agrego el tipo de indicador "'.$tipo->nombre.'" correctamente.');
    }

    public function quitartipo($tipoIndicador_id, $ponderacion_id)
    {
        $tipo = TipoIndicador::FindOrFail($tipoIndicador_id);


        DB::table('tipo_ponderaciones')->where('ponderacion_id', $ponderacion_id)->where('tipoIndicador_id', $tipoIndicador_id)->delete();

        return redirect()->back()->with('message', 'Se quito el tipo de indicador "'.$tipo->nombre.'" correctamente.');
    }

    public function agregarescala(Request $request, $ponderacion_id, $escala_id)
    {
        $escala = Escala::FindOrFail($escala_id);

        $minimo = \Request::input('minimo');
        $maximo = \Request::input('maximo');
        
        DB::table('escala_ponderacion')->insert(
             array('minimo' => $minimo,'maximo' => $maximo,'ponderacion_id' => $ponderacion_id, 'escala_id' => $escala_id)
        );

        return redirect()->back()->with('message', 'Se agrego la escala de cumplimiento "'.$escala->nombre.'" correctamente.');
    }

    public function quitarescala($escala_id, $ponderacion_id)
    {
        $escala = Escala::FindOrFail($escala_id);
        DB::table('escala_ponderacion')->where('ponderacion_id', $ponderacion_id)->where('escala_id', $escala_id)->delete();

        return redirect()->back()->with('message', 'Se quito la escala de cumplimiento "'.$escala->nombre.'" correctamente.');
    }

}
