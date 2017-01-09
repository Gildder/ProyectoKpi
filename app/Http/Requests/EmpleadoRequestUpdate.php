<?php

namespace ProyectoKpi\Http\Requests;

use ProyectoKpi\Http\Requests\Request;

class EmpleadoRequestUpdate extends Request
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
            'codigo'=>'required|max:10',
            'usuario'=>'required|max:20',
            'email'=>'required|max:30',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'departamento_id'=>'required',
            'localizacion_id'=>'required',
            'cargo_id'=>'required',
            'type_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del empleado es requerido!',
            'nombre.max' => 'El nombre completo no puede tener más de 50 carácteres',
            'usuario.required' => 'El nombre usuario es requerido!',
            'usuario.max' => 'El nombre usuario no puede tener más de 20 carácteres',
            'email.required' => 'El correo es requerido!',
            'email.max' => 'El correo no puede tener más de 30 carácteres',
            'apellidos.required' => 'Los apellidos del empleado son requeridos!',
            'apellidos.max' => 'Los apellidos no puede tener más de 50 carácteres',
            'codigo.required' => 'El codigo del empleado es requerido!',
            'codigo.max' => 'El codigo no puede tener más de 40 carácteres',
            'departamento_id.required' => 'Seleccione el departamento',
            'localizacion_id.required' => 'Seleccione la localizacion',
            'cargo_id.required' => 'Seleccione el cargo del empleado',
            'type_id.required' => 'Seleccione tipo usuario!',
        ];
    }
}
