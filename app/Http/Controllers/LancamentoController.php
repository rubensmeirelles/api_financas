<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LancamentoController extends Controller
{
    public function index()
    {
        $lancamentos = DB::table('lancamentos')->get(['descricao_lancamento', 'tipo_lancamento']);

        return response()->json([
            'status' => 'success',
            'message' => 'Lançamentos obtidos com sucesso',
            'data' => $lancamentos
        ], 200);
        
    }

    private function showData($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
