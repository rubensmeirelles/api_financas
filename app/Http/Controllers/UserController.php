<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cliente\StoreRequest as ClienteStoreRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Clientes obtidos com sucesso',
            'data' => $users
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

        $user = DB::table('users')
        ->find($request->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Cliente obtido com sucesso',
            'data' => $user
            ], 200);
    }

    public function addCliente(Request $request)
    {
        $user = DB::table('users')->insert([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Cliente adicionado com sucesso',
                'data' => $user
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

        $cliente = User::find($request->id);
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