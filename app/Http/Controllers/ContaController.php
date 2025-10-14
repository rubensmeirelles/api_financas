<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContaController extends Controller
{
    public function index()
    {
        $contas = DB::table('contas')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Contas obtidas com sucesso',
            'data' => $contas
        ], 200);
    }
}
