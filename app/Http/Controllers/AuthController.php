<?php

namespace App\Http\Controllers;

use App\Services\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validação do request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;
        $attempt = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$attempt){
            return ApiResponse::unauthorized();
        }

        $user = auth()->user();
        $token = $user->createToken($user->nome)->plainTextToken;

        return ApiResponse::success(
            [
                'id' => $user->id,
                'user' => $user->nome,
                'email' => $user->email,
                'perfil' => $user->perfil,
                'token' => $token,
            ], "Login efetuado com sucesso."
        );
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ApiResponse::success('','Logout realizado com sucesso.');
    }
}
