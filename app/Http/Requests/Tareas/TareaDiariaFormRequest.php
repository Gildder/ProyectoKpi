<?php

namespace ProyectoKpi\Http\Requests\Tareas;

use ProyectoKpi\Http\Requests\Request;

class TareaDiariaFormRequest extends Request
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
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'Este campo es requerido!',
            'descripcion.min' => 'Este campo no puede tener menos de 5 carácteres',
            'descripcion.max' => 'Este campo no puede tener más de 60 carácteres',
        ];
    }

}
