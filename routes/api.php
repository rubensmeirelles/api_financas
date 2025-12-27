<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Auth route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/add-lancamento', [LancamentoController::class, 'addLancamento']);
Route::get('/lancamentos', [LancamentoController::class, 'index'])->middleware('auth:sanctum');
Route::put('/update-lancamento', [LancamentoController::class, 'updateLancamento'])->middleware('auth:sanctum');

Route::get('/contas', [ContaController::class, 'index']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/add-user', [UserController::class, 'store']);
Route::put('/update-user/{id}', [UserController::class, 'update']);


