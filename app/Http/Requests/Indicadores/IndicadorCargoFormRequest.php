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
                'cargo_id'=>'required',
                'frecuencia_id'=>'required',
        ];
    }

   
}
