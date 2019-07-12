<?php

namespace App\Http\Controllers;

use Ping;

class PingController extends Controller
{
    public function index()
    {
        return [
            'name' => env('APP_NAME'),
            'environment' => env('APP_ENV'),
            'status' => Ping::check(env('APP_URL')),
        ];
    }
}
