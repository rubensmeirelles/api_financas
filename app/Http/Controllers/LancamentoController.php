<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Services\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LancamentoController extends Controller
{
    public function index()
    {

        $cliente_id = Auth::user()->id;

        //dd($cliente_id);
        $lancamentos = DB::table('lancamentos')
            ->leftJoin('contas', 'lancamentos.conta_id', '=', 'contas.id')
            ->leftJoin('credit_cards', 'lancamentos.credit_card_id', '=', 'credit_cards.id')
            ->leftJoin('users', 'lancamentos.user_id', '=', 'users.id')
            ->leftJoin('pessoas', 'lancamentos.pessoa_id', '=', 'pessoas.id')
            ->select(['lancamentos.id', 
                        'lancamentos.categoria_id', 
                        'lancamentos.descricao_lancamento', 
                        'lancamentos.tipo', 
                        'contas.nome_conta', 
                        'credit_cards.nome_cartao',
                        'lancamentos.parcela_inicial', 
                        'lancamentos.parcela_total',
                        'lancamentos.valor_lancamento', 
                        'lancamentos.data_compra', 
                        'lancamentos.data_vencimento', 
                        'lancamentos.mes', 
                        'lancamentos.ano', 
                        'lancamentos.user_id',
                        'users.nome',
                        'lancamentos.a_receber',
                        'pessoas.nome as nome_pesooa',])
            ->where('lancamentos.user_id', $cliente_id)
            ->orderBy("lancamentos.id", 'desc')
            ->get();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Lançamentos obtidos com sucesso',
        //     'data' => $lancamentos
        // ], 200);

        return ApiResponse::success($lancamentos, 'Lançamentos obtidos com sucesso!');
        
    }

    public function addLancamento(Request $request)
    {
        //dd($request->all());
        $lancamento = DB::table('lancamentos')-> insert([
            'descricao_lancamento' => $request->descricao_lancamento,
            'categoria_id' => $request->categoria_id,
            'tipo' => $request->tipo,
            'status' => $request->status,
            'valor_lancamento' => $request->valor_lancamento,
            'data_compra' => $request->data_compra,
            'data_vencimento' => $request->data_vencimento,
            'mes' => Carbon::parse($request->data_vencimento)->locale('pt-BR')->translatedFormat('M'),
            'ano' => Carbon::parse($request->data_vencimento)->year,
            'conta_id' => $request->conta_id,
            'credit_card_id' => $request->credit_card_id,
            'parcela_inicial' => $request->parcela_inicial,
            'parcela_total' => $request->parcela_total,
            'a_receber' => $request->a_receber,
            'user_id' => $request->user_id,
            'pessoa_id' => $request->pessoa_id,
            'created_at' => Carbon::now()
        ]);

        return ApiResponse::success($lancamento, 'Lançamento cadastrado com sucesso');      
    }

    public function updateLancamento(Request $request)
    {
        //dd($request->all());
        if(!$request->id){
            return ApiResponse::error('Lançamento não encontado.');
        }

        $lancamento = Lancamento::find($request->id);

        $lancamento->descricao_lancamento = $request->descricao_lancamento;
        $lancamento->tipo_lancamento = $request->tipo_lancamento;
        $lancamento->status_lancamento = $request->status_lancamento;
        $lancamento->valor_lancamento = $request->valor_lancamento;
        $lancamento->data_vencimento = $request->data_vencimento;
        $lancamento->data_pagamento = $request->data_pagamento;
        $lancamento->conta_id = $request->conta_id;        
        $lancamento->data_vencimento = $request->data_vencimento;
        $lancamento->user_id = $request->user_id;
        $lancamento->pessoa_id = $request->pessoa_id;
        $lancamento->updated_at = Carbon::now();
        $lancamento->save();

        return ApiResponse::success($lancamento, 'Lançamento atualizado com sucesso');
    }
}
