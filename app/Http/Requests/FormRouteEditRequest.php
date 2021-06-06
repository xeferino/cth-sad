<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRouteEditRequest extends FormRequest
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
            'name'            => 'required||min:5|unique:sections,name,'.$this->route->id,
            'code'            => 'required',
            'description'     => 'required|min:10',
            'canton_id'       => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required'         =>  'El nombre es requerido.',
            'name.min'              =>  'El nombre debe contener un minimo de 5 caracteres.',
            'name.unique'           =>  'El nombre ingresado ya existe, este debe ser unico por cada encuesta.',
            'code.required'         =>  'El codigo es requerido.',
            'canton_id.required'    =>  'El canton es requerido.',
            'description.required'  =>  'La descripcion es requerida.',
            'description.min'       =>  'La descripcion debe contener un minimo de 10 caracteres.',
        ];
    }
}
