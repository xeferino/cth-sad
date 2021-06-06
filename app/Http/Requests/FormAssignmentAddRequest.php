<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAssignmentAddRequest extends FormRequest
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
            'canton_id'        => 'required',
            'pollster_id'      => 'required',
            'period_id'        => 'required'
        ];

    }

    public function messages()
    {
        return [
            'canton_id.required'        => 'El canton es requerido.',
            'pollster_id.required'      => 'El Encuestador es requerido.',
            'period_id.required'        => 'El Periodo es requerido.',
        ];
    }
}
