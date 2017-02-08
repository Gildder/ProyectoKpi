<?php

namespace ProyectoKpi\Http\Requests\Tareas;

use ProyectoKpi\Http\Requests\Request;

class TareaDiariasResolverRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'fechaInicioSolucion'=> 'required',
                'fechaFinSolucion' => 'required|date|after:fechaInicioSolucion',
                'tiempoSolucion'=> 'required',
                'estado'=> 'required',
                'observaciones'=>'max:120',

        ];
    }

    public function messages()
    {
        return [
            'fechaInicioSolucion.required' => 'Este campo es requerido!',
            'fechaFinSolucion.required' => 'Este campo es requerido!',
            'fechaFinSolucion.after' => 'Este esta antes de la fecha de inicio!',
            'tiempoSolucion.required' => 'Este campo es requerido!',
            'estado.required' => 'Este campo es requerido!',
            'observaciones.max' => 'Este campo no puede tener más de 120 carácteres',

        ];
    }
}
