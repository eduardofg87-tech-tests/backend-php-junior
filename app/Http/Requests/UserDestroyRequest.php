<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return auth('api')->check() && auth('api')->user()->isNot($this->user);
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
