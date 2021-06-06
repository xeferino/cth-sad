<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUserAddRequest extends FormRequest
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
        if ($this->hasFile('img')) {
            return [
                'name'          => 'required|min:3',
                'last_name'     => 'required|min:3',
                'email'         => 'required|email|unique:users,email',
                'role'          => 'required',
                'cpassword'     => 'required',
                'password'      => 'required|min:8|max:16|required_with:cpassword|same:cpassword',
                'img'           => 'nullable|sometimes|mimes:jpeg,png,svg|max:1014',
            ];
        }else{
            return [
                'name'          => 'required|min:3',
                'last_name'     => 'required|min:3',
                'email'         => 'required|email|unique:users,email',
                'role'          => 'required',
                'cpassword'     => 'required',
                'password'      => 'required|min:8|max:16|required_with:cpassword|same:cpassword',
            ];
        }

    }

    public function messages()
    {
        return [
            'role.required'         =>  'El rol es requerido.',
            'name.required'         =>  'El nombre es requerido.',
            'name.min'              =>  'El nombre debe contener un minimo de 3 caracteres.',
            'last_name.required'    =>  'El apellido es requerido.',
            'last_name.min'         =>  'El apellido debe contener un minimo de 3 caracteres.',
            'email.required'        =>  'El email es requerido.',
            'email.email'           =>  'Ingrese un email valido!',
            'email.unique'          =>  'El email ingresado ya existe!',
            'cpassword.required'    =>  'Confirmar clave es requerida.',
            'password.required'     =>  'La clave es requerida.',
            'password.min'          =>  'La clave debe debe contener un minimo de 8 caracteres.',
            'password.max'          =>  'La clave debe debe contener un maximo de 16 caracteres.',
            'password.same'         =>  ' La clave y confirmar clave deben coincidir.',
            'img.mimes'             =>  ' El formato de imagen no esta permitido, la imagen debe ser jpeg, png o svg.',
            'img.max'               =>  'El peso maximo de la imagen es de 1014 KB.',
        ];
    }
}
