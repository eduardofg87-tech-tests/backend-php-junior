<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Mockery\Exception;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Clients::all();

        if($clients->count() > 0){
            $result = response()->json(['data' => $clients], 201);
        }else{
            $result = response()->json(['mensagem' => 'Não Foram encontrados clientes cadastrados'], 404);
        }

        return $result;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        try{
            $insert = Clients::create($request->all());
            if($insert->id){
               return response()->json(['mensagem' => 'usuário cadastrado com sucesso!', 'id_usuario' => $insert->id], 201);
            }else{
                throw new \Exception("Falha ao inserir os dados");
            }
        }catch (Exception $e){
            return response()->json(['mensagem' => 'houve um problema ao cadastrar os dados!'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Clients::find($id);

        if(!empty($client)){
            $result = response()->json($client,201);
        }else{
            $result = response()->json(['mensagem' => 'cliente não encontrado'], 404);
        }

        return $result;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {

        try{
            $updatedQuantity = Clients::where('id', $id)->update($request->all());

            if($updatedQuantity > 0){
                return response()->json(['mensagem' => 'usuário atualizado com sucesso!'], 201);
            }else{
                throw new \Exception("Falha ao atualizar os dados");
            }

        }catch (Exception $e){
              return response()->json(['mensagem', 'Falha ao atualizar os dados'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $client = Clients::find($id);

            if(empty($client)){
                return response()->json(['mensagem' => 'usuário não foi encontrado!']);
            }

            $isDeleted = $client->delete();

            if($isDeleted){
                return response()->json(['mensagem' => 'usuario removido com sucesso!!'], 201);
            }else{
                throw new Exeption("Falha ao remover os dados solicitados");
            }

        } catch (Exception $e) {
            return response()->json(['mensagem' => 'Erro ao remover o usuário'], 500);
        }
    }
}
