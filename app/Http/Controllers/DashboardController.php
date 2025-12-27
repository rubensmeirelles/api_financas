<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $mes = $request->query('mes', now()->month);
        $ano = $request->query('ano', now()->year);

        $totalSaida = Lancamento::where('user_id', $userId)
            ->where('tipo', 'Saida')
            ->whereMonth('data_vencimento', $mes)
            ->whereYear('data_vencimento', $ano)
            ->sum('valor_lancamento');

        $totalEntrada = Lancamento::where('user_id', $userId)
            ->where('tipo', 'Entrada')
            ->whereMonth('data_vencimento', $mes)
            ->whereYear('data_vencimento', $ano)
            ->sum('valor_lancamento');

        $totalAReceber = Lancamento::where('user_id', $userId)
            ->where('a_receber', 'S')
            ->whereMonth('data_vencimento', $mes)
            ->whereYear('data_vencimento', $ano)
            ->sum('valor_lancamento');

        return response()->json([
            'mes' => (int) $mes,
            'ano' => (int) $ano,
            'total_saida' => (float) $totalSaida,
            'total_entrada' => (float) $totalEntrada,
            'total_a_receber' => (float) $totalAReceber,
        ]);
    }
}
