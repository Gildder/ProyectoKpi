<?php

namespace ProyectoKpi\Http\Requests\Empleados;

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
            $tecnico_id = 'unique:users,tecnico_id,'. $this->get('id');
        }
        else
        {
            $tecnico_id = 'unique:users,tecnico_id';
        }

        return [
            'codigo'=>'required|max:10',
            'tecnico_id'=> $tecnico_id,
            'name'=>'required|max:20',
            'email'=>'required|max:50',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'cargo_id'=>'required',
            'type'=>'required',
            'grdepartamento_id'=>'required',
            'grlocalizacion_id'=>'required',
            'departamento_id'=>'required',
            'localizacion_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del empleado es requerido!',
            'tecnico_id.unique' => 'El Id del Tecnico ta existe',
            'nombre.max' => 'El nombre completo no puede tener más de 50 carácteres',
            'name.required' => 'El nombre usuario es requerido!',
            'name.max' => 'El nombre usuario no puede tener más de 20 carácteres',
            'email.required' => 'El correo es requerido!',
            'email.max' => 'El correo no puede tener más de 50 carácteres',
            'apellidos.required' => 'Los apellidos del empleado son requeridos!',
            'apellidos.max' => 'Los apellidos no puede tener más de 50 carácteres',
            'codigo.required' => 'El codigo del empleado es requerido!',
            'codigo.max' => 'El codigo no puede tener más de 40 carácteres',
            'departamento_id.required' => 'Seleccione el departamento',
            'localizacion_id.required' => 'Seleccione la localizacion',
            'cargo_id.required' => 'Seleccione el cargo del empleado',
            'type.required' => 'Seleccione tipo usuario!',
            'grdepartamento_id.required' => 'Seleccione el grupo departamento',
            'grlocalizacion_id.required' => 'Seleccione el grupo localizacion',
        ];
    }
}
