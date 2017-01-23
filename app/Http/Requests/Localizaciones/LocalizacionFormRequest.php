<?php

namespace ProyectoKpi\Http\Requests\Localizaciones;

use ProyectoKpi\Http\Requests\Request;

class LocalizacionFormRequest extends Request
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
            $nombre = 'required|min:5|max:20|unique:localizaciones,nombre,'. $this->get('id');
            $telefono = 'required|max:20|unique:localizaciones,telefono,'. $this->get('id');
        }
        else
        {
            // Create operation. There is no id yet.
            $nombre = 'required|min:5|max:20|unique:localizaciones,nombre';
            $telefono = 'required|max:20|unique:localizaciones,telefono';
        }
        return [
            'nombre'=>$nombre,
            'direccion'=>'required|min:5|max:20',
            'telefono'=>$telefono,
            'grupoloc_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido!',
            'nombre.unique' => 'El campo nombre ya existe',
            'nombre.min' => 'El campo nombre no puede tener menos de 5 carácteres',
            'nombre.max' => 'El campo nombre no puede tener más de 20 carácteres',
            'telefono.required' => 'El campo telefono es requerido!',
            'telefono.unique' => 'El campo telefono ya existe',
            'telefono.min' => 'El campo telefono no puede tener menos de 5 carácteres',
            'telefono.max' => 'El campo telefono no puede tener más de 20 carácteres',
            'direccion.required' => 'El campo direccion es requerido!',
            'direccion.min' => 'El campo direccion no puede tener menos de 5 carácteres',
            'direccion.max' => 'El campo direccion no puede tener más de 20 carácteres',
            'grupoloc_id.required' => 'El campo grupo localizacion es requerido!',
        ];
    }
}
