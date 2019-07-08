<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    public function health()
    {
        try{
            $connection = DB::connection()->getPdo();
            return response()->json(['status' => 'Todos os serviços estão online'], 201);
        }catch (\PDOException $e){
            return response()->json(['status' => 'Falha', 'mensagem' => 'um ou mais serviços não estão ativos'], 404);
        }
    }
}
