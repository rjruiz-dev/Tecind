<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        $rules = [           
            // 'name_company'  => 'required', 
            'name'          => 'required',            
            'denomination'  => 'required',
            'code'          => 'required',
            'quantity'      => 'required',
            'date'          => 'required',
            'status'        => 'required',

          
        ];

        // Si es diferente a Post
        if($this->method() !== 'PUT')
        {
            $rules ['name_company' ]    = 'required' . $this->id;
            // $rules ['status' ]          = 'required' . $this->id;
            // $rules ['name' ]            = 'required' . $this->id;
            // $rules ['date' ]            = 'required' . $this->id;
            // $rules ['denomination' ]    = 'required' . $this->id;
            // $rules ['quantity' ]        = 'required' . $this->id;
            // $rules ['code' ]            = 'required' . $this->id;
            $rules ['order' ]           = 'required|numeric|unique:orders,order' . $this->id;            
             
        }

        return $rules;   
       
    }

    public function messages()
    {
        return [
            'order.required'          => 'El numero de orden es obligatorio.',
            'order.unique'            => 'Este numero de orden ya ha sido registrado.',          
            'name_company.required'   => 'Debe seleccionar un cliente.',
            'denomination.required'   => 'Debe ingresar nombre.',
            'name.required'           => 'Debe seleccionar un operario.',
            'code.required'           => 'Debe ingresar un codigo de  pieza.',
            'quantity.required'       => 'Debe ingresar una cantidad.',
            'date.required'           => 'Debe seleccionar una fecha.',
            'status.required'         => 'Debe seleccionar una estado .',
           
        ];
    }
}
