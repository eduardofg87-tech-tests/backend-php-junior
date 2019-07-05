<?php

namespace App\Http\Requests;

use App\Rules\ValidateCPF;
use App\Traits\JsonableErrors;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    use JsonableErrors;

    public function authorize()
    {
        return auth('api')->check();
    }

    public function rules()
    {
        return [
            'name'  => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,' . $this->user->id,
            'cpf'   => ['required', 'min:11', 'max:11', new ValidateCPF]
        ];
    }
}
