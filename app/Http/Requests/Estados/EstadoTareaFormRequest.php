<?php

namespace ProyectoKpi\Http\Requests\Estados;

use ProyectoKpi\Http\Requests\Request;

class EstadoTareaFormRequest extends Request
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

    public function response(array $errors)
    {
        return $this->redirector->to($this->getRedirectUrl())
            ->withErrors($errors, $this->errorBag)
            ->withInput($this->all());
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
            $nombre = 'required|min:5|max:20|unique:estado_tareas,nombre,'. $this->get('id');
            $descripcion = 'required|max:120';
            if($this->get('id') == 1  || $this->get('id') == 3){
                $nombre = '';
                $descripcion = '';
            }
        }
        else
        {
            // Create operation. There is no id yet.
            $nombre = 'required|min:5|max:20|unique:estado_tareas,nombre';
            $descripcion = 'required|max:120';
        }
        return [
            'nombre'=>$nombre,
            'descripcion' => $descripcion,
            'color' => 'required',
            'texto' => 'required',
            'visibleCalendario' => 'required',
            'visibleEmpleado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido!',
            'nombre.min' => 'El nombre no puede tener menos de 5 carácteres',
            'nombre.max' => 'El nombre no puede tener más de 20 carácteres',
            'nombre.unique' => 'El nombre ya existe',
            'descripcion.required' => 'La descripcion es requerido!',
            'descripcion.max' => 'La descripcion no puede tener más de 120 carácteres',
            'color.required' => 'El campo es requerido!',
            'texto.required' => 'El campo es requerido!',
            'visibleCalendario.required' => 'El campo es requerido!',
            'visibleEmpleado.required' => 'El campo es requerido!',
        ];
    }
}
