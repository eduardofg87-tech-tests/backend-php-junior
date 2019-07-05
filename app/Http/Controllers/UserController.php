<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

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
}
