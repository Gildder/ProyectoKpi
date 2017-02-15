<?php

namespace ProyectoKpi\Http\Requests\Tareas;

use ProyectoKpi\Http\Requests\Request;

class TareaProgramasFormRequest extends Request
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
                'descripcion'=>'required|min:5|max:60',
                'fechaInicioEstimado' => 'required|date_format:d/m/Y',
                'fechaFinEstimado' => 'required|date_format:d/m/Y',
                'hora'=> 'required|numeric',
                'minuto'=> 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'La descripcion es requerida!',
            'descripcion.min' => 'Este campo no puede tener menos de 5 carácteres',
            'descripcion.max' => 'Este campo no puede tener más de 60 carácteres',
            'fechaInicioEstimado.required' => 'Este campo es requerido!',
            'fechaInicioEstimado.date_format' => 'El formato es dd/mm/aaa',
            'fechaFinEstimado.required' => 'Este campo es requerido!',
            'fechaFinEstimado.date_format' => 'El formato es dd/mm/aaa',
            'hora.required' => 'La Hora es requerido',
            'hora.numeric' => 'Debe ser numerico',
            'minuto.required' => 'El minuto es requerido',
            'minuto.numeric' => 'Debe ser numerico'
        ];
    }
}
