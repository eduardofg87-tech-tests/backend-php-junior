<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated());
    }

    public function show(Request $request, User $user)
    {
        return $user;
    }

    public function destroy(UserDestroyRequest $request, User $user)
    {
        $user->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
