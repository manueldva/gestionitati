<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name'      => 'required',
            'username'  => 'required|unique:users,username',
            //'email'     => 'required|unique:users,email,'. $this->user,
            'perfil_id'     => 'required'

        ];

        if($this->get('email'))
            $rules = array_merge($rules, ['email'     => 'required|unique:users,email']);


        return $rules;

        /*return [
            'name'      => 'required',
            'username'     => 'required|unique:users,username',
            //'email'     => 'required|unique:users,email',
            'perfil_id'     => 'required'
        ];*/
    }
}
