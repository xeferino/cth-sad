<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCustomerEditRequest extends FormRequest
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
            'document_e'          => 'required',
            'names_e'             => 'required|min:3',
            'surnames_e'          => 'required|min:3',
            'phone_e'             => 'required|numeric|min:11',
            'address_e'           => 'required|string|min:4',
            'email_e'             => 'required|email',
            'type_e'              => 'required',
            'social_e'            => 'required|string|min:4',
            'turn_e'              => 'required|string|min:4',
            'city_e'              => 'required',
            'commune_e'           => 'required',
            'region_e'            => 'required',
        ];
    }

    public function messages()
    {
        return [
            'document_e.required'      =>  'El documento es requerido.',
            'document_e.unique'        =>  'El documento ingresado ya existe!',
            'names_e.required'         =>  'El nombre es requerido.',
            'names_e.min'              =>  'El nombre debe contener un minimo de 3 caracteres.',
            'surnames_e.required'      =>  'El apellido es requerido.',
            'surnames_e.min'           =>  'El apellido debe contener un minimo de 3 caracteres.',
            'phone_e.required'         =>  'El telefono es requerido.',
            'phone_e.numeric'          =>  'El telefono acepata solo numeros.',
            'phone_e.min'              =>  'El telefono debe contener un minimo de 11 caracteres.',
            'address_e.required'       =>  'La direccion es requerida.',
            'address_e.min'            =>  'La direccion debe  contener un minimo de 4 caracteres.',
            'email_e.required'         =>  'El email es requerido.',
            'email.email'            =>  'Ingrese un email valido!',
            'email_e.unique'           =>  'El email ingresado ya existe!',
            'type_e.required'          =>  'El tipo cliente es requerido.',
            'social_e.required'        =>  'La razon social es requerida.',
            'social_e.min'             =>  'La razon social debe  contener un minimo de 4 caracteres.',
            'turn_e.required'          =>  'El giro es requerido.',
            'turn_e.min'               =>  'El giro debe  contener un minimo de 4 caracteres.',
            'city_e.required'          =>  'La ciudad es requerida.',
            'commune_e.required'       =>  'La comuna es requerida.',
            'region_e.required'        =>  'La region es requerida.'
        ];
    }
}
