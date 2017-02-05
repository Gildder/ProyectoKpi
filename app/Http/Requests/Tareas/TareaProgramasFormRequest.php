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
                'nombre'=>'required|min:5|max:60',
                'fechaInicioEstimado'=> 'required',
                'fechaFinEstimado'=> 'required',
                'tiempoEstimado'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Este campo es requerido!',
            'nombre.min' => 'Este campo no puede tener menos de 5 carácteres',
            'nombre.max' => 'Este campo no puede tener más de 60 carácteres',
            'fechaInicioEstimado.required' => 'Este campo es requerido!',
            'fechaFinEstimado.required' => 'Este campo es requerido!',
            'tiempoEstimado.required' => 'Este campo es requerido!',
        ];
    }
}
