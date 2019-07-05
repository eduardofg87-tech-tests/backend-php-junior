<?php

namespace App\Http\Requests;

use App\Rules\ValidateCPF;
use App\Traits\JsonableErrors;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    use JsonableErrors;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'cpf'      => ['required', 'string', 'min:11', 'max:11', 'unique:users,cpf', new ValidateCPF],
            'password' => 'required|min:8|max:255'
        ];
    }
}
