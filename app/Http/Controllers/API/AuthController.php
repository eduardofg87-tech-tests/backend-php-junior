<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        
        $credentials = request(['email', 'password']);
        
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'message' => $validator->messages()
            ]);
        }
           
        // tenta autenticar e receber o token 
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Não existe uma conta com estas credenciais.'
            ], 401);
        }
        
        $expiresIn = auth('api')->payload()->get('exp'); 
        
        // retorna o token e demais informações
        return response()->json([
            'status' => 'success',
            'message' => 'Usuário criado e JWT encontrado',
            'tokenjwt' => $token,
            'expires' =>  \Carbon\Carbon::createFromTimestamp($expiresIn)->toDateString(),  
            'tokenmsg' => 'use o token para acessar os endpoints!',
            'User' => auth('api')->user() 
        ]);
    }

    public function logout() 
    {
        auth()->logout();

        return response()->json(['message' => 'Deslogado com sucesso!']);
    }
}
