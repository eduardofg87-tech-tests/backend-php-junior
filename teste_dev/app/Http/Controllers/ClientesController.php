<?php

namespace App\Http\Controllers;
use App\cliente;
use Illuminate\Http\Request;
use Redirect;

class ClientesController extends Controller
{
    public function index ()
    {
      $clientes = cliente::get();
      return view ('clientes.lista', ['clientes' => $clientes]);
    }
    public function novo ()
    {
      return view ('clientes.formulario');
    }
    public function salvar (Request $request)
    {
      $cliente = new cliente();
      $cliente = $cliente->create($request->all());
      \Session::flash('mensagem_sucesso', 'cliente cadastrado com sucesso!');
      return Redirect::to('clientes/novo');
    }

    public function editar ($id)
    {
      $cliente = Cliente::findOrFail($id);
      return view ('clientes.formulario', ['cliente' => $cliente]);
    }

    public function atualizar($id, Request $request)
    {
      $cliente = Cliente::findOrFail($id);
      $cliente->update($request->all());
      \Session::flash('mensagem_sucesso', 'cliente atualizado com sucesso!');
      return Redirect::to('clientes/'.$cliente->id.'/editar');
    }
    public function deletar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        \Session::flash('mensagem_sucesso', 'cliente excluido com sucesso!');
        return Redirect::to('clientes');
    }

}
