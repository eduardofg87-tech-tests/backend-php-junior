<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function store(Request $request)
    {
        $this->validateLogin($request);
        $credentials = $this->credentials($request);
        $token = \JWTAuth::attempt($credentials);
        return $this->responseToken($token);
    }

    private function responseToken($token)
    {
        if ($token) {
            return [
                'token' => $token,
            ];
        }
        return response()->json([
            'error' => \Lang::get('auth.failed')
        ], 400);
    }
}
