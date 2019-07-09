<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(){
        return [
            'name.required' => "informe um nome para o usuário",
            'name.string'   => "informe um valor válido",
            'name.max'      => "maximo de caracteres é 255",
            'email.required'=> "informe um e-mail",
            'email.email'   => "informe um formato válido de email",
            'email.max'     => "maximo de caracteres é 255",
            'email.unique'  => "esse email já está em uso"
        ];
    }
}
