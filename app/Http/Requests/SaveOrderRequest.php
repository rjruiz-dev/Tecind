<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveOrderRequest extends FormRequest
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
            'name_company'  => 'required',            
            'name'          => 'required',
            'order'         => 'required|numeric|unique:orders',           
            'denomination'  => 'required'           
                                     
        ];

       
    }

    public function messages()
    {
        return [
            'order.required'          => 'El numero de orden es obligatorio.',
            'order.unique'            => 'Este numero de orden ya ha sido registrado.',          
            // 'name_company.required'   => 'Debe seleccionar un cliente.',
            'denomination.required'   => 'Debe ingresar nombre de producto.',
            'name.required'           => 'Debe seleccionar un operario.'
           
        ];
    }
}
