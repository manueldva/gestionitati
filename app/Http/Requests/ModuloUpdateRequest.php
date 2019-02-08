<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuloUpdateRequest extends FormRequest
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

        //dd($this->modulo);

        return [
            'descripcion' => 'required|unique:modulos,descripcion,' . $this->modulo,
            'link' => 'required|unique:modulos,link,' . $this->modulo,
            'valor' => 'required|unique:modulos,valor,' .$this->modulo   
        ];
    }
}
