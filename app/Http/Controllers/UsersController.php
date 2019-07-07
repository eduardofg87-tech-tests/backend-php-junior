<?php

namespace App\Http\Controllers;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exeptions\JWTException;
use Tymon\JWTAuth\Exeptions\TokenExpiredException;
use Tymon\JWTAuth\Exeptions\TokenInvalidException;
use App\Http\Requests\UsersRequest;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function login(){

        $credentials = \request(['email', 'password']);

        if(!$token = auth('api')->attempt($credentials)){
            return response()->json(['error' => 'usuario ou senha inválidos']);
        }

        return $this->reponseWithToken($token);
    }

    public function register(UsersRequest $request){

        $user = $request->only('name', 'email', 'password');
        $insert = User::create($user);

        if($insert->id){
           return $this->login();
        }else{
            return response()->json(['error' => 'falha ao cadastrar o usuário']);
        }
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['message' => 'logout feito com sucesso']);
    }


    public function refresh(){
        return $this->reponseWithToken(auth()->refresh());
    }

    public function me(){
        return response()->json(auth('api')->user());
    }

    protected function reponseWithToken($token)
    {
        return response()->json([
           "status" => "success",
           "message" => "Usuário logado com sucesso",
           "token" => $token,
           "expires" => auth('api')->factory()->getTTL() * 60,
           "user" => auth('api')->user()
        ]);
    }




}
