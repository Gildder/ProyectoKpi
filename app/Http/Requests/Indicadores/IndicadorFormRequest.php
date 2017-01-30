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
            $nombre = 'required|min:5|max:100|unique:indicadores,nombre,'. $this->get('id');
        }
        else
        {
            // Create operation. There is no id yet.
            $nombre = 'required|min:5|max:100|unique:indicadores,nombre';
        }
        return [
            'nombre'=>$nombre,
            'orden'=>'required',
            'descripcion_objetivo'=>'required|max:100',
            'tipo_indicador_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido!',
            'nombre.min' => 'El campo nombre no puede tener menos de 5 carácteres',
            'nombre.max' => 'El campo nombre no puede tener más de 100 carácteres',
            'nombre.unique' => 'El campo nombre ya existe',
            'orden.required' => 'Este campo es requerido!',
            'descripcion_objetivo.required' => 'Este campo es requerido!',
            'descripcion_objetivo.max' => 'Este campo no puede tener más de 100 carácteres',
            'tipo_indicador_id.required' => 'Este campo es requerido!',
        ];
    }
}
