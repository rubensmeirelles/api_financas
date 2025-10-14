<?php

namespace App\Http\Controllers;

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

    public function addCliente(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => ['required'],
            'email' => ['required', 'email', 'unique:clientes'],
        ]);

        dd($validatedData);
   
        $cliente = DB::table('clientes')->insert([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Cliente adicionado com sucesso',
                'data' => $cliente
            ], 200
        );        
    }
}