<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    //método GET para visualizar todos os usuários
    public function index()
    {
        $Users = User::all();
        if(!$Users){
            return response()->json([
                'message' => 'Record not found',
            ],404);
        }
        return response()->json($Users);
    }

    //método GET para visualizar um usuário pelo ID 
    public function show($id)
    {
        $User = User::find($id);
        if(!$User){
            return response()->json([
                'message' => 'Record not found',
            ],404);
        }
        return response()->json($User);
    }

    //método POST para incluir um usuário
    public function store(Request $request)
    {
        $User = new User;
        $User->fill($request->all());
        $User['password'] = bcrypt($User['password']);
        $User['email_verified_at'] = NOW();
        $User['remember_token'] = Str::random(10);    
        $User->save();
        return response()->json($User, 201);
    }

    //método PUT para atualizar um usuário pelo ID
    public function update(Request $request, $id)
    {
        $User = User::find($id);
        if(!$User) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }
        $User->fill($request->all());
        $User->save();
        return response()->json($User);
    }

    //método DELETE para excluir um usuário pelo ID
    public function destroy($id)
    {
        $User = User::find($id);
        if(!$User) {
        return response()->json([
            'message' => 'Record not found',
        ], 404);
        }
        $User->delete();
        return response()->json([
            'message' => 'Deleted user',
        ], 200);
    }
}
