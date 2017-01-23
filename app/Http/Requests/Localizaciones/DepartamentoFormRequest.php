<?php

namespace ProyectoKpi\Http\Requests\Localizaciones;

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
        if ($this->method() == 'PUT')
        {
            // Update operation, exclude the record with id from the validation:
            $nombre = 'required|min:5|max:45|unique:departamentos,nombre,'. $this->get('id');
        }
        else
        {
            // Create operation. There is no id yet.
            $nombre = 'required|min:5|max:45|unique:departamentos,nombre';
        }
        return [
            'nombre'=>$nombre,
            'grupodep_id'=>'required',
        ];
    } 

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido!',
            'nombre.unique' => 'El campo nombre ya existe',
            'nombre.min' => 'El campo nombre no puede tener menos de 5 carácteres',
            'nombre.max' => 'El campo nombre no puede tener más de 45 carácteres',
            'grupodep_id.required' => 'El campo grupo departamento es requerido!',
        ];
    }
}
