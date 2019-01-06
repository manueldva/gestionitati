<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilUpdateRequest extends FormRequest
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
        // utilizo la info de url por que por alguna razon no funciona $this->perfil
        /*$perfil = request()->pathInfo;
        $cant = strpos($perfil, '/', 1) + 1;
        $perfil = substr($perfil, $cant);*/
        //
        //dd($this->perfil);

        return [
            'perfil' => 'required|unique:perfiles,perfil,' . $this->perfile //. $perfil
        ];
    }
}
