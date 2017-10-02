<?php

namespace ProyectoKpi\Http\Requests\Tareas;

use ProyectoKpi\Http\Requests\Request;
use Illuminate\Routing\Route;

class TareaProgramasFormAgendaRequest extends Request
{
    function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
//    public function response(array $errors)
//    {
//        return $this->redirector->to($this->getRedirectUrl())
//            ->withErrors($errors, $this->errorBag)
//            ->withInput($this->all());
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'PUT'){ // las fechas estimadas son requeridos
            $fechaInicio = 'required';
            $fechaFin = 'required';
            $estado = 'required';
        }else{
            $fechaInicio = '';
            $fechaFin = '';
            $estado = '';
        }

        return [
                'descripcion'=>'required|min:5|max:120',
                'fechaInicioEstimado' => $fechaInicio,
                'fechaFinEstimado' => $fechaFin,
                'estado'=> $estado,
                'hora'=> 'required',
                'minuto'=> 'required',
                'observaciones'=>'max:120',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'La descripcion es requerida!',
            'descripcion.min' => 'Este campo no puede tener menos de 5 carácteres',
            'descripcion.max' => 'Este campo no puede tener más de 120 carácteres',
            'fechaInicioEstimado.required' => 'Este campo Fecha Inicio es requerido!',
            'fechaFinEstimado.required' => 'Este campo Fecha Fin es requerido!',
            'hora.required' => 'La Hora es requerido',
            'minuto.required' => 'El Minuto es requerido',
            'observaciones.max' => 'Este campo no puede tener mas de 120 carácteres',
        ];
    }
}
