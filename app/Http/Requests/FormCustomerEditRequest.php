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
        if ($this->hasFile('img')) {
            return [
                'name'          => 'required|min:3',
                'last_name'     => 'required|min:3',
                'email'         => 'required|email',
                'document'      => 'required|numeric',
                'phone'         => 'nullable|numeric|min:11',
                'mobile'        => 'nullable|numeric|min:11',
                'city'          => 'nullable|string|min:4',
                'province'      => 'nullable|string|min:4',
                'address'       => 'nullable|string|min:4',
                'number_measurer'  => 'nullable|numeric|min:4',
                'rate'          => 'nullable|string|min:4',
                'half'          => 'nullable|string|min:4',
                'code'          => 'nullable|string|min:4',
                'obervation'    => 'nullable|string|min:10',
                'gender'        => 'required',
                'route'         => 'required',
                'img'           => 'nullable|sometimes|mimes:jpeg,png,svg|max:1014',

            ];
        }else{
            return [
                'name'          => 'required|min:3',
                'last_name'     => 'required|min:3',
                'email'         => 'required|email',
                'document'      => 'required|numeric',
                'phone'         => 'nullable|numeric|min:11',
                'mobile'        => 'nullable|numeric|min:11',
                'city'          => 'nullable|string|min:4',
                'province'      => 'nullable|string|min:4',
                'address'       => 'nullable|string|min:4',
                'number_measurer' => 'nullable|numeric|min:4',
                'rate'          => 'nullable|string|min:4',
                'half'          => 'nullable|string|min:4',
                'code'          => 'nullable|string|min:4',
                'obervation'    => 'nullable|string|min:10',
                'gender'        => 'required',
                'route'         => 'required',
            ];
        }

    }

    public function messages()
    {
        return [
            'name.required'         =>  'El nombre es requerido.',
            'name.min'              =>  'El nombre debe contener un minimo de 3 caracteres.',
            'last_name.required'    =>  'El apellido es requerido.',
            'last_name.min'         =>  'El apellido debe contener un minimo de 3 caracteres.',
            'email.required'        =>  'El email es requerido.',
            'email.email'           =>  'Ingrese un email valido!',
            'document.required'     =>  'El documento es requerido.',
            'document.unique'       =>  'El documento ingresado ya existe!',
            'email.unique'          =>  'El email ingresado ya existe!',
            'phone.numeric'         =>  'El telefono acepata solo numeros.',
            'phone.min'             =>  'El telefono debe contener un minimo de 11 caracteres.',
            'mobile.numeric'         => 'El celular acepata solo numeros.',
            'mobile.min'             => 'El celular debe contener un minimo de 11 caracteres.',
            'city.min'              =>  'La ciudad debe contener un minimo de 4 caracteres.',
            'province.min'          =>  'La provincia debe contener un minimo de 4 caracteres.',
            'address.min'           =>  'La direccion debe  contener un minimo de 4 caracteres.',
            'img.mimes'             =>  ' El formato de imagen no esta permitido, la imagen debe ser jpeg, png o svg.',
            'gender.required'       =>  'El sexo es requerido.',
            'route.required'        =>  'La ruta es requerida.',
            'img.max'               =>  'El peso maximo de la imagen es de 1014 KB.',
            'number_measurer.min'   =>  'El numeros de medidor de 4 caracteres.',
            'number_measurer.numeric' => 'El numeros de medidor acepata solo numeros.',
            'rate.min'              =>  'La tarifa debe contener un minimo de 4 caracteres.',
            'half.min'              =>  'El promedio debe contener un minimo de 4 caracteres.',
            'code.min'              =>  'El codigo debe  contener un minimo de 4 caracteres.',
            'obervation.min'        =>  'La observacion debe contener un minimo de 10 caracteres.',
        ];
    }
}
