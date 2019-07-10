<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthSigninRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function signin(AuthSigninRequest $request)
    {
        $token = auth('api')->attempt($request->validated());

        if (!$token) {
            return response()->json(
                ['status'  => 'Error', 'message' => 'Usuário não pode ser autenticado!'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $tokenExpiration = auth('api')->payload()->get('exp');

        return response()->json([
            'status'        => 'success',
            'message'       => 'Usuário encontrado e JWT criado',
            'token_jwt'     => $token,
            'expires_in'    => Carbon::createFromTimestamp($tokenExpiration)->toDateString(),
            'token_message' => 'Use o token para acessar os endpoints!',
            'user'          => auth('api')->user()
        ]);
    }
}
