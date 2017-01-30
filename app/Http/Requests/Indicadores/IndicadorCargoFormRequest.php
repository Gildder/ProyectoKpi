<?php

namespace ProyectoKpi\Http\Requests\Indicadores;

use ProyectoKpi\Http\Requests\Request;

class IndicadorCargoFormRequest extends Request
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
                'condicion'=>'max:120',
                'aclaraciones'=>'max:120',
                'objetivo'=>'required|max:3',
                'frecuencia_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'condicion.max' => 'Este campo no puede tener más de 120 carácteres',
            'aclaraciones.max' => 'Este campo no puede tener más de 120 carácteres',
            'objetivo.required' => 'Este campo es requerido!',
            'objetivo.max' => 'El campo  no puede tener más de 3 digitos',
            'frecuencia_id.required' => 'Este campo es requerido!'
        ];
    }
}
