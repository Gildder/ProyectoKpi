<?php

namespace ProyectoKpi\Http\Requests\Tareas;

use ProyectoKpi\Http\Requests\Request;

class TareaProgramasResolverRequest extends Request
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
                'fechaInicioSolucion' => 'required|date_format:d/m/Y',
                'fechaFinSolucion' => 'required|date_format:d/m/Y',
                'hora'=> 'required|numeric',
                'minuto'=> 'required|numeric',
                'estado'=> 'required',
                'observaciones'=>'max:120',

        ];
    }

    public function messages()
    {
        return [
            'fechaInicioSolucion.required' => 'La fecha de Inicio es requerido!',
            'fechaInicioSolucion.date_format' => 'El formato es dd/mm/aaa',
            'fechaFinSolucion.required' => 'La fecha de Fin es requerido!',
            'fechaFinSolucion.date_format' => 'El formato es dd/mm/aaa',
            'estado.required' => 'El estado es requerido!',
             'hora.required' => 'La Hora es requerido',
            'hora.numeric' => 'Debe ser numerico',
            'minuto.required' => 'El minuto es requerido',
            'minuto.numeric' => 'Debe ser numerico',
            'observaciones.max' => 'Este campo no puede tener más de 120 carácteres',

        ];
    }
}
