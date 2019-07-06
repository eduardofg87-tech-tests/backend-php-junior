<?php

namespace App\Http\Controllers;

class PingController extends Controller
{
    public function index()
    {
        return [
            'name' => env('APP_NAME'),
            'environment' => env('APP_ENV'),
            'connection' => $this->connection(),
        ];
    }

    public function connection()
    {
        try {
            mysqli_connect(
                env('DB_HOST'),
                env('DB_USERNAME'),
                env('DB_PASSWORD'),
                env('DB_DATABASE')
            );
            return true;
        }catch (\ErrorException $e) {
            return $e->getMessage();
        }
    }
}
