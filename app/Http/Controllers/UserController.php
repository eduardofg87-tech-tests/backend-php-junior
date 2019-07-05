<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated());
    }
}
