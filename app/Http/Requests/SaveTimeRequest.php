<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTimeRequest extends FormRequest
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
            'order_id'          => 'required',                      
            'amount'            => 'required',
            'minute'            => 'required',
            'machine_id'        => 'required',         
            'preparation_time'  => 'required'         
           
        ];
    }

    public function messages()
    {
        return [
            'order_id.required'         => 'Debe seleccionar un numero de orden.',           
            'amount.required'           => 'Debe ingresar una cantidad.',
            'minute.required'           => 'Debe ingresar el tiempo de fabricación.',
            'machine_id.required'       => 'Debe seleccionar maquina cnc.',    
            'preparation_time.required' => 'Debe ingresar el tiempo de preparación.'                    
        ];
    }
}
