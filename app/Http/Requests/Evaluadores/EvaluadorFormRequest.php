<?php

namespace ProyectoKpi\Http\Requests\Evaluadores;

use ProyectoKpi\Http\Requests\Request;


class EvaluadorFormRequest extends Request
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
            $abreviatura = 'required|max:10|unique:evaluadores,abreviatura,'. $this->get('id');
            $descripcion = 'required|max:40|unique:evaluadores,descripcion,'. $this->get('id');
        }
        else
        {
            // Create operation. There is no id yet.
            $abreviatura = 'required|max:10|unique:evaluadores,abreviatura';
            $descripcion = 'required|max:40|unique:evaluadores,descripcion';
        }
        return [
            'abreviatura'=>$abreviatura,
            'descripcion'=>$descripcion,
            'ponderacion_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'abreviatura.required' => 'El campo abreviatura es requerido!',
            'abreviatura.max' => 'El campo abreviatura no puede tener más de 10 carácteres',
            'abreviatura.unique' => 'El campo abreviatura ya existe',
            'descripcion.required' => 'El campo descripcion es requerido!',
            'descripcion.max' => 'El campo descripcion no puede tener más de 40 carácteres',
            'descripcion.unique' => 'El campo descripcion ya existe',
            'ponderacion_id.required' => 'El campo ponderacion es requerido!',
        ];
    }
}
