<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LancamentoController extends Controller
{
    public function index()
    {
        $lancamentos = DB::table('lancamentos')
            ->join('contas', 'lancamentos.conta_id', '=', 'contas.id')
            ->join('users', 'lancamentos.user_id', '=', 'users.id')
            ->select(['lancamentos.id', 'descricao_lancamento', 'tipo_lancamento', 'lancamentos.conta_id','nome_conta', 'valor_lancamento', 'data_vencimento', 'lancamentos.user_id','nome'])
            ->orderBy("lancamentos.id", 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Lançamentos obtidos com sucesso',
            'data' => $lancamentos
        ], 200);
        
    }

    public function addLancamento(Request $request)
    {
        //dd($request->all());
        $lancamento = DB::table('lancamentos')-> insert([
            'descricao_lancamento' => $request->descricao_lancamento,
            'tipo_lancamento' => $request->tipo_lancamento,
            'status_lancamento' => $request->status_lancamento,
            'valor_lancamento' => $request->valor_lancamento,
            'data_vencimento' => $request->data_vencimento,
            'data_pagamento' => $request->data_pagamento,
            'conta_id' => $request->conta_id,
            'user_id' => $request->cliente_id,
            'created_at' => Carbon::now()
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Lançamento cadastrado com sucesso',
                'data' => $lancamento
            ], 201);      
    }

    public function updateLancamento(Request $request)
    {
        if(!$request->id){
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Id do lançamento é obrigatório'
                ],
                400
            );
        }

        $lancamento = Lancamento::find($request->id);

        $lancamento->descricao_lancamento = $request->descricao_lancamento;
        $lancamento->tipo_lancamento = $request->tipo_lancamento;
        $lancamento->conta_id = $request->conta_id;
        $lancamento->valor_lancamento = $request->valor_lancamento;
        $lancamento->data_vencimento = $request->data_vencimento;
        $lancamento->cliente_id = $request->cliente_id;

        $lancamento->save();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Lançamento atualizado com sucesso',
                'data' => $lancamento
            ], 201
        );    

    }
}
