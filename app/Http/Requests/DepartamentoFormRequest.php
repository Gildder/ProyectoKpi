<?php

namespace ProyectoKpi\Http\Requests;

use ProyectoKpi\Http\Requests\Request;

class DepartamentoFormRequest extends Request
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
            'nombre'=>'required|min:5|max:45',
            'grupodep_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido!',
            'nombre.min' => 'El campo title no puede tener menos de 5 carácteres',
            'max.min' => 'El campo title no puede tener más de 45 carácteres',
            'grupodep_id.required' => 'El campo grupo departamento es requerido!',
        ];
    }
}
