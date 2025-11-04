<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Auth route
Route::post('/login', [AuthController::class, 'login']);

Route::get('/lancamentos', [LancamentoController::class, 'index']);
Route::get('/contas', [ContaController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'client']);
Route::post('/add-user', [UserController::class, 'addUser']);
Route::put('/update-user', [UserController::class, 'updateUser']);
Route::post('/add-lancamento', [LancamentoController::class, 'addLancamento']);
Route::put('/update-lancamento', [LancamentoController::class, 'updateLancamento']);

