<?php

namespace ProyectoKpi\Http\Requests\Indicadores;

use ProyectoKpi\Http\Requests\Request;

class ErrorFormRequest extends Request
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
            'descripcion'=>'required|max:120',
        ];
    } 


    public function messages()
    {
        return [
            'descripcion.required' => 'Este campo es requerido!',
            'descripcion.max' => 'Este campo no puede tener más de 120 carácteres',
        ];
    }
    
}
