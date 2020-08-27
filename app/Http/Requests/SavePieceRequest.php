<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SavePieceRequest extends FormRequest
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
            'part_piece'        => 'required',                    
            'number_program'    => 'required',         
            'time'              => 'required',            
            'machine_id'        => 'required',
            'order_id'          => 'required', 
            'tools'             => 'required',        
        ];

        // Si es diferente a Post
        if($this->method() !== 'PUT')
        {
            $rules ['number_gag' ]   = 'required' . $this->id;
         
                      
        }

        return $rules;    

        // return [                               
        //     'part_piece'        => 'required',
        //     'number_gag'        => 'required',          
        //     'number_program'    => 'required',         
        //     'time'              => 'required',            
        //     'machine_id'        => 'required',
        //     'order_id'          => 'required', 
        //     'tools'             => 'required', 
           
        // ];
    }

    public function messages()
    {
        return [
            'part_piece.required'       => 'Debe seleccionar parte.', 
            'number_gag.required'       => 'Debe seleccionar número de mordaza.',       
            'time.required'             => 'Debe ingresar el tiempo de fabricación.',  
            'tools.required'            => 'Debe ingresar al menos una herramienta.',  
            'number_program.required'   => 'Debe ingresar número de programa.',          
            'machine_id.required'       => 'Debe seleccionar maquina cnc.',                    
            'order_id.required'         => 'Debe seleccionar un nombre de pieza.'          
                     
        ];
    }
}
