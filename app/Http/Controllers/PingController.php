<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class PingController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'status'  => Response::HTTP_OK,
            'message' => 'Server up and running...'
        ]);
    }
}
