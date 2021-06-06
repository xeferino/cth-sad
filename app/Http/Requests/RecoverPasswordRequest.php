<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecoverPasswordRequest extends FormRequest
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
                'email'         => 'required|email',
                'code'          => 'required|numeric',
                'password'      => 'required|min:8|max:16|required_with:cpassword|same:cpassword',
        ];
    }

    public function messages()
    {
        return [
            'code.numeric'          =>  'El codigo acepata solo numeros.',
            'code.required'         =>  'El codigo es requerido.',
            'email.required'        =>  'El email es requerido.',
            'email.email'           =>  'Ingrese un email valido!',
            'password.required'     =>  'La clave es requerida.',
            'password.min'          =>  'La clave debe debe contener un minimo de 8 caracteres.',
            'password.max'          =>  'La clave debe debe contener un maximo de 16 caracteres.',
            'password.same'         =>  ' La clave y confirmar clave deben coincidir.',
        ];
    }
}
