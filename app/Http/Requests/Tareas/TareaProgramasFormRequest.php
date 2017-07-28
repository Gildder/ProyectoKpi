<?php

namespace ProyectoKpi\Http\Requests\Tareas;

use ProyectoKpi\Http\Requests\Request;

class TareaProgramasFormRequest extends Request
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
        if($this->get('estimados') == 1){ // las fechas estimadas son requeridos
            $fechaInicioEstimado = 'required|date_format:d/m/Y|before_equal:fechaFinEstimado';
            $fechaFinEstimado = 'required|date_format:d/m/Y|after_equal:fechaInicioEstimado';
        }else{
            $fechaInicioEstimado = 'date_format:d/m/Y|before_equal:fechaFinEstimado';
            $fechaFinEstimado = 'date_format:d/m/Y|after_equal:fechaInicioEstimado';
        }
        return [
                'descripcion'=>'required|min:5|max:60',
                'fechaInicioEstimado' => $fechaInicioEstimado,
                'fechaFinEstimado' => $fechaFinEstimado,
                'hora'=> 'required',
                'minuto'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'La descripcion es requerida!',
            'descripcion.min' => 'Este campo no puede tener menos de 5 carácteres',
            'descripcion.max' => 'Este campo no puede tener más de 60 carácteres',
            'fechaInicioEstimado.required' => 'Este campo es requerido!',
            'fechaInicioEstimado.date_format' => 'El formato es dd/mm/aaaa',
            'fechaInicioEstimado.before_equal' => 'La fecha inicio debe ser menor o igual a la fecha fin',
            'fechaFinEstimado.required' => 'Este campo es requerido!',
            'fechaFinEstimado.date_format' => 'El formato es dd/mm/aaaa',
            'fechaFinEstimado.after_equal' => 'La fecha fin debe ser mayor o igual a la fecha comienzo',
            'hora.required' => 'La Hora es requerido',
            'minuto.required' => 'El minuto es requerido',
        ];
    }
}
