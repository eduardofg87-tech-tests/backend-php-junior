<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exeptions\JWTException;
use Tymon\JWTAuth\Exeptions\TokenExpiredException ;
use Tymon\JWTAuth\Exeptions\TokenInvalidException;
use Illuminate\Support\Facades\Validator;
use App\Requests\UsersRequest;


class UsersController extends Controller
{
    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        try {

            if(!$token = JWAuth::attempt($credentials)){
                return response()->json(['error' => 'usuário ou senha inválidos'], 400);
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'não foi possível gerar o token de autorização'], 400);
        }

        return response()->json(compact($token));
    }


    public function register(UsersRequest $request){

        $user = User::create($request->all());

        $token = JWAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);

    }

    public function me(){

        try {

            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
