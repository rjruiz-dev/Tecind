<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePostsRequest extends FormRequest
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
            'title'         => 'required|min:3',            
            'body'          => 'required',
            'category_id'   => 'required',       
            'tags'          => 'required',           
            'excerpt'       => 'required'                                      
        ];   
    }

    public function messages()
    {
        return [         
            'title.required'    => 'El titulo de la publicacion es obligatorio.',
            'body.required'     => 'Debe ingresar un contenido.',
            'category_id.required' => 'Debe seleccionar una categoria.',
            'tags.required'     => 'Debe seleccionar al menos una etiqueta.',
            'excerpt.required'  => 'Debe ingresar un extracto.'
           
        ];
    }
}
