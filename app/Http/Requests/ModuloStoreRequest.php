<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuloStoreRequest extends FormRequest
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
            'descripcion' => 'required|unique:modulos,descripcion',
            'link' => 'required|unique:modulos,link',
            'valor' => 'required|unique:modulos,valor'  
        ];
    }
}
