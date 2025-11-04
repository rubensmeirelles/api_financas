<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get(
            [
                'id', 'nome', 'email', 'perfil'
            ]
        );

        return ApiResponse::success($users, 'Lista de usuários obtida com sucesso.');
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
        return ApiResponse::error('Usuário não encontrado.');
    }

        return ApiResponse::success($user, 'Usuário obtido com sucesso.');
    }

    public function store(UserRequest $request)
    {
        //dd($request->all());
        $user = User::create($request->validated());

        return ApiResponse::created($user, 'Registo adicionado com sucesso.');
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
        return ApiResponse::error('Usuário não encontrado.', 404);
    }

        $user->update($request->validated());

        return ApiResponse::success($user, 'Usuário atualizado com sucesso.');
    }
}