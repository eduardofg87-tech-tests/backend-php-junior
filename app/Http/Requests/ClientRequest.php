<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'  => 'required',
            'cpf'   => 'required|Numeric|unique:clients,cpf',
            'email' => 'required|email|unique:clients,email'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'informe um nome para o cliente',
            'cpf.required'  => 'informe o cpf',
            'cpf.Numeric'   => 'informe numeros para o cpf',
            'cpf.unique'   => 'esse cpf já está cadastrado',
            'email.required'=> 'informe o e-mail',
            'email.email'   => 'informe um email válido',
            'email.unique'  => 'esse email já está cadastrado'
        ];
    }
}
