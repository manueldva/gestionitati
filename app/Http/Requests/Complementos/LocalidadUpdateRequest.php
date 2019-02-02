<?php

namespace App\Http\Requests\Complementos;

use Illuminate\Foundation\Http\FormRequest;

class LocalidadUpdateRequest extends FormRequest
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
            /*'provincia_id' => 'required',
            'departamento_id' => 'required',*/
            'descripcion' => 'required|max:350'
        ];
    }
}
