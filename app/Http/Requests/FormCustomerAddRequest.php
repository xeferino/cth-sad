<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCustomerAddRequest extends FormRequest
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
            'document'          => 'required|unique:tb_clientes,documento',
            'names'             => 'required|min:3',
            'surnames'          => 'required|min:3',
            'phone'             => 'required|numeric|min:11',
            'address'           => 'required|string|min:4',
            'email'             => 'required|email|unique:tb_clientes,email',
            'type'              => 'required',
            'social'            => 'required|string|min:4',
            'turn'              => 'required|string|min:4',
            'city'              => 'required',
            'commune'           => 'required',
            'region'            => 'required',
        ];
    }

    public function messages()
    {
        return [
            'document.required'      =>  'El documento es requerido.',
            'document.unique'        =>  'El documento ingresado ya existe!',
            'names.required'         =>  'El nombre es requerido.',
            'names.min'              =>  'El nombre debe contener un minimo de 3 caracteres.',
            'surnames.required'      =>  'El apellido es requerido.',
            'surnames.min'           =>  'El apellido debe contener un minimo de 3 caracteres.',
            'phone.required'         =>  'El telefono es requerido.',
            'phone.numeric'          =>  'El telefono acepata solo numeros.',
            'phone.min'              =>  'El telefono debe contener un minimo de 11 caracteres.',
            'address.required'       =>  'La direccion es requerida.',
            'address.min'            =>  'La direccion debe  contener un minimo de 4 caracteres.',
            'email.required'         =>  'El email es requerido.',
            'email.email'            =>  'Ingrese un email valido!',
            'email.unique'           =>  'El email ingresado ya existe!',
            'type.required'          =>  'El tipo cliente es requerido.',
            'social.required'        =>  'La razon social es requerida.',
            'social.min'             =>  'La razon social debe  contener un minimo de 4 caracteres.',
            'turn.required'          =>  'El giro es requerido.',
            'turn.min'               =>  'El giro debe  contener un minimo de 4 caracteres.',
            'city.required'          =>  'La ciudad es requerida.',
            'commune.required'       =>  'La comuna es requerida.',
            'region.required'        =>  'La region es requerida.'
        ];
    }
}
