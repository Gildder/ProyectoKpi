<?php

namespace ProyectoKpi\Http\Requests\Procesos;

use ProyectoKpi\Http\Requests\Request;

class AprobacionFormRequest extends Request
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
            'evaluador_id'=>'required',
            'opcion_id'=>'required',
            'user_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'evaluador_id.required' => 'El evaludor del empleado es requerido',
            'opcion_id.required' => 'Seleccione una opcion de aprobación',
            'user_id.required' => 'El usuario aprobador es requerido',
        ];
    }
}
