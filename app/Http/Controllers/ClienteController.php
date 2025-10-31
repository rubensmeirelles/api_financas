<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\StoreRequest;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = DB::table('clientes')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Clientes obtidos com sucesso',
            'data' => $clientes
        ], 200);
    }

    public function client(Request $request)
    {
        if(!$request->id){
            return response()->json([
            'status' => 'error',
            'message' => 'Id do cliente é obrigatório'
            ], 400);
        } 

        $cliente = DB::table('clientes')
        ->find($request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Cliente obtido com sucesso',
            'data' => $cliente
            ], 200);
    }

    public function addCliente(StoreRequest $request)
    {
        $cliente = DB::table('clientes')->insert([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Cliente adicionado com sucesso',
                'data' => $cliente
            ], 201
        );        
    }

    public function updateCliente(Request $request)
    {
        if(!$request->id){
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Id do cliente é obrigatório'
                ],
                400
            );
        }

        $cliente = Cliente::find($request->id);
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->save();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Cliente atualizado com sucesso',
                'data' => $cliente
            ], 201
        );    
    }
}