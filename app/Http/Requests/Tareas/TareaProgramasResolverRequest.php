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
            'fechaInicioSolucion' => 'required',
            'fechaFinSolucion' => 'required|date_format:d/m/Y',
            'hora'=> 'required',
            'minuto'=> 'required',
            'estado'=> 'required',
            'observaciones'=>'max:120',

        ];
    }

    public function messages()
    {
        return [
            'fechaInicioSolucion.required' => 'La fecha de Inicio es requerido!',
            'fechaFinSolucion.required' => 'La fecha de Fin es requerido!',
            //'fechaInicioSolucion.date_format' => 'El formato es dd/mm/aaaa',
            'fechaFinSolucion.date_format' => 'El formato es dd/mm/aaaa',
            'estado.required' => 'El estado es requerido!',
            'hora.required' => 'La Hora es requerido',
            'minuto.required' => 'El minuto es requerido',
            'observaciones.max' => 'Este campo no puede tener más de 120 carácteres',

        ];
    }
}
