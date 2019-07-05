<?php

namespace App\Http\Requests;

use App\Traits\JsonableErrors;
use Illuminate\Foundation\Http\FormRequest;

class AuthSigninRequest extends FormRequest
{
    use JsonableErrors;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string'
        ];
    }
}
