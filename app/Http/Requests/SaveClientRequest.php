<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveClientRequest extends FormRequest
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
        $rules = [           
            'name_client'   => 'required|string|min:3|max:50',
            'lastname'      => 'required|string|min:3|max:50',                     
          
        ];

        // Si es diferente a Post
        if($this->method() !== 'PUT')
        {
            $rules ['email' ]   = 'required|string|email|max:255|unique:clients,email,' . $this->id;
            $rules ['cuit' ]    = 'required|string|unique:companies,cuit' . $this->id;            
            $rules ['phone_client' ]    = 'required|string|unique:clients,phone_client' . $this->id;   
            $rules ['name_company' ]   = 'required|string|min:3|max:50|unique:companies,name_company' . $this->id;           
            $rules ['phone_company' ]   = 'required|string|unique:companies,phone_company' . $this->id;            
        }

        return $rules;      
     
    } 
    
    public function messages()
    {
        return [
            'name_company.required' => 'Debe introducir un nombre de empresa.',
            'name_company.unique'   => 'El nombre de empresa del contacto ya ha sido registrado.',
            'name_company.min'      => 'El nombre de empresa debe contener al menos 3 caracteres.',
            'name_company.max'      => 'El nombre de empresa debe contener un maximo 50 caracteres.',

            'name_client.required'  => 'Debe introducir un nombre de contacto.',
            'name_client.min'       => 'El nombre de cliente debe contener al menos 3 caracteres.',
            'name_client.max'       => 'El nombre de cliente debe contener un maximo 50 caracteres.',

            'lastname.required'     => 'Debe introducir un apellido para el contacto',
            'lastname.min'          => 'El apellido de cliente debe contener al menos 3 caracteres.',
            'lastname.max'          => 'El apellido de cliente debe contener un maximo 50 caracteres.',

            'cuit.required'         => 'Debe introducir un numero de cuit valido.',    
            'cuit.unique'           => 'Este numero de cuit ya ha sido registrado.',               

            'phone_client.required' => 'Debe introducir un numero de telefono valido.',
            'phone_client.unique'   => 'El numero de telefono del contacto ya ha sido registrado.',
            
            'phone_company.required' => 'Debe introducir un numero de telefono valido.',
            'phone_company.unique'   => 'El numero de telefono de la empresa ya ha sido registrado.',

            'email.required'        => 'Debe introducir un correo electronico.',        
            'email.unique'          => 'Este email ya ha sido registrado.',           
        ];
    }
} 
