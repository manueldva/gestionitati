<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloUpdateRequest extends FormRequest
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
            //'codigo' => 'required|max:50|unique:articulos,codigo, ' . $this->articulo,
            'descripcion' => 'required|max:250|unique:articulos,descripcion, '  . $this->articulo,
            'tipoarticulo_id' => 'required',
            /*'stock' => 'required',
            'stockminimo' => 'required',
            'preciounitario' => 'required',
            'estado'    => 'required|in:Activo,Inactivo'*/
        ];
    }

    public function messages()
    {
      return [
        'tipoarticulo_id.required' => 'El campo tipo de producto es obligatorio.',
      ];
    }
}