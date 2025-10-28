<?php

namespace App\Http\Controllers;

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
            ->join('clientes', 'lancamentos.cliente_id', '=', 'clientes.id')
            ->select(['lancamentos.id', 'descricao_lancamento', 'tipo_lancamento', 'conta', 'valor_lancamento', 'data_vencimento', 'nome'])
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
            'conta_id' => $request->conta_id,
            'valor_lancamento' => $request->valor_lancamento,
            'data_vencimento' => $request->data_vencimento,
            'cliente_id' => $request->cliente_id,
            'created_at' => Carbon::now()
        ]);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Lançamento cadastrado com sucesso',
                'data' => $lancamento
            ], 201);      
    }
}
