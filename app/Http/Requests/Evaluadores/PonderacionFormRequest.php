<?php

namespace ProyectoKpi\Http\Requests\Evaluadores;

use ProyectoKpi\Http\Requests\Request;

class PonderacionFormRequest extends Request
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
            $nombre = 'required|max:50|unique:ponderaciones,nombre,'. $this->get('id');
            $descripcion = 'required|max:120';
        }
        else
        {
            // Create operation. There is no id yet.
            $nombre = 'required|max:50|unique:ponderaciones,nombre';
            $descripcion = 'required|max:120';
        }
        return [
                'nombre'=>$nombre,
                'descripcion'=>$descripcion,
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido!',
            'nombre.max' => 'El campo nombre no puede tener más de 50 carácteres',
            'nombre.unique' => 'El campo nombre ya existe',
            'descripcion.required' => 'El campo descripcion es requerido!',
            'descripcion.max' => 'El campo descripcion no puede tener más de 120 carácteres',
        ];
    }
}
