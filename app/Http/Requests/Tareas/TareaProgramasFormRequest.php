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
            $fechaInicioEstimado = 'required|date_format:d/m/Y|before_equal:fechaFinEstimado|regex:/^\d{1,2}\/\d{1,2}\/\d{4}$/';
            $fechaFinEstimado = 'required|date_format:d/m/Y|after_equal:fechaInicioEstimado|regex:/^\d{1,2}\/\d{1,2}\/\d{4}$/';
            $estado = 'required';
        }else{
            $fechaInicioEstimado = 'date_format:d/m/Y|before_equal:fechaFinEstimado|regex:/^\d{1,2}\/\d{1,2}\/\d{4}$/';
            $fechaFinEstimado = 'date_format:d/m/Y|after_equal:fechaInicioEstimado|regex:/^\d{1,2}\/\d{1,2}\/\d{4}$/';
            $estado = '';
        }

        return [
                'descripcion'=>'required|min:5|max:120',
                'fechaInicioEstimado' => $fechaInicioEstimado,
                'fechaFinEstimado' => $fechaFinEstimado,
                'estado'=> $estado,
                'hora'=> 'required',
                'minuto'=> 'required',
                'observaciones'=>'max:120',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'La descripcion es requerida!',
            'descripcion.min' => 'Este campo no puede tener menos de 5 carácteres',
            'descripcion.max' => 'Este campo no puede tener más de 120 carácteres',
            'fechaInicioEstimado.required' => 'Este campo Fecha Inicio es requerido!',
            'fechaInicioEstimado.date_format' => 'El formato de la Fecha Inicio es dd/mm/aaaa',
            'fechaInicioEstimado.regex' => 'El formato de la Fecha Inicio es  dd/mm/aaaa',
            'fechaInicioEstimado.before_equal' => 'La Fecha Inicio debe ser menor o igual a la Fecha Fin',
            'fechaFinEstimado.required' => 'Este campo Fecha Fin es requerido!',
            'fechaFinEstimado.date_format' => 'El formato de la Fecha Fin es  dd/mm/aaaa',
            'fechaFinEstimado.regex' => 'El formato de la Fecha Fin es  dd/mm/aaaa',
            'fechaFinEstimado.after_equal' => 'La Fecha Fin debe ser mayor o igual a la Fecha Inicio',
            'hora.required' => 'La Hora es requerido',
            'minuto.required' => 'El Minuto es requerido',
            'observaciones.max' => 'Este campo no puede tener mas de 120 carácteres',
        ];
    }
}
