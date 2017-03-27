<?php

namespace ProyectoKpi\Http\Requests\Indicadores;

use ProyectoKpi\Http\Requests\Request;

class IndicadorFormRequest extends Request
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
        if ($this->method() == 'PUT')
        {
            // Update operation, exclude the record with id from the validation:
            $nombre = 'required|min:5|max:50|unique:indicadores,nombre,'. $this->get('id');
        }
        else
        {
            // Create operation. There is no id yet.
            $nombre = 'required|min:5|max:50|unique:indicadores,nombre';
        }
        return [
            'nombre'=>$nombre,
            'orden'=>'required',
            'descripcion'=>'required|max:120',
            'tipo_indicador_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido!',
            'nombre.max' => 'El campo nombre no puede tener más de 50 carácteres',
            'nombre.unique' => 'El campo nombre ya existe',
            'orden.required' => 'Este campo es requerido!',
            'descripcion.required' => 'Este campo es requerido!',
            'descripcion.max' => 'Este campo no puede tener más de 120 carácteres',
            'tipo_indicador_id.required' => 'Este campo es requerido!',
        ];
    }
}
