<?php

namespace ProyectoKpi\Http\Requests\Tareas;

use ProyectoKpi\Http\Requests\Request;

class TareaProgramasResolverRequest extends Request
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
            'fechaInicioSolucion' => 'required',
            'fechaFinSolucion' => 'required|date_format:d/m/Y',
            'hora'=> 'required',
            'minuto'=> 'required|min:1',
//            'estado'=> 'required',
            'observaciones'=>'max:120',
            'prov'=> 'required',

        ];
    }

    public function messages()
    {
        return [
            'fechaInicioSolucion.required' => 'La fecha de Inicio es requerido!',
            'fechaFinSolucion.required' => 'La fecha de Fin es requerido!',
            //'fechaInicioSolucion.date_format' => 'El formato es dd/mm/aaaa',
            'fechaFinSolucion.date_format' => 'El formato es dd/mm/aaaa',
//            'estado.required' => 'El estado es requerido!',
            'hora.required' => 'La Hora es requerido',
            'minuto.required' => 'El minuto es requerido',
            'minuto.min' => 'El minuto es requerido',
            'observaciones.max' => 'Este campo no puede tener más de 120 carácteres',
            'prov.required' => 'Seleccionar minimo una localizacion',

        ];
    }
}
