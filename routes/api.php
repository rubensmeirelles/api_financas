<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\LancamentoController;
use Illuminate\Support\Facades\Route;


    Route::get('/lancamentos', [LancamentoController::class, 'index']);
    Route::get('/contas', [ContaController::class, 'index']);
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::post('/cliente', [ClienteController::class, 'client']);
    Route::post('/add-cliente', [ClienteController::class, 'addCliente']);
    Route::put('/update-cliente', [ClienteController::class, 'updateCliente']);
    Route::post('/add-lancamento', [LancamentoController::class, 'addLancamento']);
    Route::put('/update-lancamento', [LancamentoController::class, 'updateLancamento']);

