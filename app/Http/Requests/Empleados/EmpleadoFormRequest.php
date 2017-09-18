<?php

namespace ProyectoKpi\Http\Requests\Empleados;

use ProyectoKpi\Http\Requests\Request;

class EmpleadoFormRequest extends Request
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
        return [
            'codigo'=>'required|max:10',
            'usuario'=>'required|max:20',
            'tecnico_id'=>'unique:users',
            'email'=>'required|max:50',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'grdepartamento_id'=>'required',
            'departamento_id'=>'required',
            'grlocalizacion_id'=>'required',
            'localizacion_id'=>'required',
            'cargo_id'=>'required',
            'type_id'=>'required',
            'password'=>'required|AlphaNum|min:8|Confirmed',
            'password_confirmation'=>'Required|AlphaNum|min:8'
        ];
    }

    public function messages()
    {
        return [
            'nombres.required' => 'El nombre del empleado es requerido!',
            'tecnico_id.unique' => 'El Id del Tecnico ta existe',
            'nombres.max' => 'El nombre completo no puede tener más de 50 carácteres',
            'usuario.required' => 'El nombre usuario es requerido!',
            'usuario.max' => 'El nombre usuario no puede tener más de 20 carácteres',
            'email.required' => 'El correo es requerido!',
            'email.max' => 'El correo no puede tener más de 50 carácteres',
            'apellidos.required' => 'Los apellidos del empleado son requeridos!',
            'apellidos.max' => 'Los apellidos no puede tener más de 50 carácteres',
            'codigo.required' => 'El codigo del empleado es requerido!',
            'codigo.max' => 'El codigo no puede tener más de 40 carácteres',
            'grdepartamento_id.required' => 'Seleccione el grupo departamento',
            'departamento_id.required' => 'Seleccione el departamento',
            'grlocalizacion_id.required' => 'Seleccione el grupo localizacion',
            'localizacion_id.required' => 'Seleccione la localizacion',
            'cargo_id.required' => 'Seleccione el cargo del empleado',
            'type_id.required' => 'Seleccione tipo usuario!',
            'password.required' => 'Coloque la Contraseña!',
            'password_confirmation.required' => 'Repita la contraseña!',
        ];
    }
}
