<?php

namespace ProyectoKpi\Http\Controllers\Calendario;

use function count;
use Illuminate\Http\Request;

use function json_encode;
use ProyectoKpi\Http\Controllers\Controller;
use ProyectoKpi\Models\Tareas\TareaComun;
use stdClass;

class EmpleadoTareaCalendarioController extends Controller
{
    public function listaMiTareas()
    {
        $data = array();

        $tareas = TareaComun::where('user_id', \Usuario::get('id'))->get();

        foreach ($tareas as $tarea){
            $valor = new \stdClass();

            $valor->title = $tarea->titulo;
            $valor->start = $tarea->fechaInicio;
            $valor->end = $tarea->fechaFin;
            $valor->allDay = $tarea->todoeldia;
            $valor->backgroundColor = $tarea->color;
            $valor->id = $tarea->id;

            array_push($data, $valor);
        }

//        dd(json_encode($data));

        return view('calendario.empleado.index');
    }

    public function guardarTareaPro(Request $request)
    {
        $tarea = new Tarea;
        $tarea->numero = $tarea->getNumero();
        $tarea->descripcion = trim(\Request::input('titulo'));
        $tarea->fechaInicioEstimado = $tarea->validarFechaInicioEstimacion(\Request::input('fechaInicioEstimado'));
        $tarea->fechaFinEstimado = $tarea->validarFechaFinEstimacion(\Request::input('fechaFinEstimado'));
        $horaReal = $tarea->obtenerHora(trim(\Request::input('hora')), trim(\Request::input('minuto')));
        $tarea->tiempoEstimado = $horaReal[0].':'.$horaReal[1];
        $tarea->tipoTarea_id = '1';
        $tarea->estadoTarea_id = '1';
        $tarea->user_id = \Usuario::get('id');

        // valimidamos los limite de las fecha de inicio y fin de semana
        if(!$tarea->validarLimiteFechas()){
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('Las fechas estan fuera del rango permitido.')
                ->withInput();
        }

        if ($tarea->save()) {
            return redirect('tareas/tareaProgramadas')
                ->with('message', 'La nueva tarea se guardo correctamente');
        } else {
            return redirect()->to($this->getRedirectUrl())
                ->withErrors('La tarea NO se guardo, por favor verifique los campos')
                ->withInput();
        }


    }

    public function cargarTareas()
    {
        ini_set('max_execution_time', 300);
        $data = array();

        $tareas = TareaComun::where('user_id', \Usuario::get('id'))->get();

        foreach ($tareas as $tarea){
            $valor = new \stdClass();

            $valor->title = $tarea->titulo;
            $valor->start = $tarea->fechaInicio;
            $valor->end = $tarea->fechaFin;
            $valor->allDay = $tarea->todoeldia;
            $valor->backgroundColor = $tarea->color;
            $valor->id = $tarea->id;

            array_push($data, $valor);
        }

//        dd(json_encode($data));
        return json_encode($data);

    }

    public function guardarTarea(Request $request)
    {
        $tarea = TareaComun::create([
            'titulo' => $request->titulo,
            'fechaInicio' => $request->fechaInicio,
            'fechaFin' => $request->fechaFin,
            'todoeldia' => true,
            'color' => $request->color,
            'user_id' => \Usuario::get('id'),
        ]);

        if(isset($tarea)){
            return Response()->json(['request' =>true, 'eventid'=>$tarea->id]);
        }else{
            return Response()->json(false);
        }

    }

    public function actualizarTareaHora(Request $request)
    {
        $tarea = TareaComun::findOrFail($request->id);
        $tarea->titulo = $request->titulo;
        $tarea->fechaInicio = $request->fechaInicio;
        $tarea->fechaFin = $request->fechaFin;
        $tarea->todoeldia = $request->todoeldia;
        $tarea->color = $request->color;
        $tarea->user_id = \Usuario::get('id');

        if($tarea->save()){
            return Response()->json(true);
        }else{
            return Response()->json(false);
        }
    }
}
