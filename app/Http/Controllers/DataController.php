<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function open(){
        $data = "Esses dados não podem ser acessados sem um usuário estar autenticado";
        return reposnse()->json(compact('data'), 200);
    }

    public function closed(){
        $data = "Apenas usuários autorizados podem acessar esse recurso";
        return reponse()->json(compact('data'), 200);
    }
}
