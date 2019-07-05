<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return auth('api')->user()->id !== $this->user->id;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
