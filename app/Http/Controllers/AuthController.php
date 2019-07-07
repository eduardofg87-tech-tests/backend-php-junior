<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Lang;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $credentials = $this->credentials($request);
        $token = auth('api')->attempt($credentials);
        return $this->responseToken($token);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(Lang::get('auth.logout'), 204);
    }

    private function responseToken($token)
    {
        if ($token) {
            return [
                'status' => 'success',
                'message' => Lang::get('auth.success'),
                'tokenjwt' => $token,
                'expires' => date('Y-m-d', auth('api')->payload()->get('exp')),
                'tokenmsg' => Lang::get('auth.tokenmsg'),
                'User' => auth('api')->user(),
            ];
        }
        return response()->json([
            'status' => 'error',
            'message' => Lang::get('auth.failed')
        ], 500);
    }
}
