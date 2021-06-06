<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPeriodAddRequest extends FormRequest
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
            'start'         => 'required|date|after_or_equal:'.date('Y-m-d'),
            'end'           => 'required|date|after:start',
            'poll_id'       => 'required',
        ];

    }

    public function messages()
    {
        return [
            'start.required'         => 'La Fecha de inicio es requerida.',
            'start.date'             => 'El Formato de la fecha de inicio es incorrecto.',
            'start.after_or_equal'   => 'La fecha de inicio debe ser mayor o igual a la fecha actual '.date('Y-m-d'),
            'end.date'               => 'El Formato de la fecha de finalizacion es incorrecto.',
            'end.required'           => 'La Fecha de finalizacion es requerida.',
            'end.after'              => 'La Fecha de finalizacion debe ser mayor a la fecha de inicio.',
            'poll_id.required'       => 'La Encuesta es requerida.'
        ];
    }
}
