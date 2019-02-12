<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoStoreRequest extends FormRequest
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
            //'codigo' => 'required|max:50|unique:articulos,codigo',
            'apellido' => 'required|max:100',
            'nombre' => 'required|max:100',
            'tipoempleado_id' => 'required'
            //'estado'    => 'required|in:Activo,Inactivo'
        ];
    }
}