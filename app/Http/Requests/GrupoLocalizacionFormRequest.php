<?php

namespace ProyectoKpi\Http\Requests;

use ProyectoKpi\Http\Requests\Request;

class GrupoLocalizacionFormRequest extends Request
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
            'nombre'=>'required|min:5|max:45|unique:grupolocalizaciones,nombre',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido!',
            'nombre.unique' => 'El campo nombre ya existe',
            'nombre.min' => 'El campo nombre no puede tener menos de 5 carácteres',
            'nombre.max' => 'El campo nombre no puede tener más de 45 carácteres',
        ];
    }
}
