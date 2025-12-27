<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Auth route
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/add-lancamento', [LancamentoController::class, 'addLancamento']);
    Route::get('/lancamentos', [LancamentoController::class, 'index']);
    Route::put('/update-lancamento', [LancamentoController::class, 'updateLancamento']);
    Route::delete('/delete-lancamento/{id}', [LancamentoController::class, 'deleteLancamento']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/contas', [ContaController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/add-user', [UserController::class, 'store']);
    Route::put('/update-user/{id}', [UserController::class, 'update']);
});



