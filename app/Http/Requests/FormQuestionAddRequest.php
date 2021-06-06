<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormQuestionAddRequest extends FormRequest
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
            'name'            => 'required||min:5|unique:questions,name',
            'description'     => 'required||min:10',
            'type'            => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required'         =>  'El nombre es requerido.',
            'name.min'              =>  'El nombre debe contener un minimo de 5 caracteres.',
            'name.unique'           =>  'El nombre ingresado ya existe, este debe ser unico por cada seccion.',
            'description.required'  =>  'La descripcion es requerida.',
            'description.min'       =>  'La descripcion debe contener un minimo de 10 caracteres.',
            'type.required'         =>  'El tipo de Pregunta es requerido.',
        ];
    }
}
